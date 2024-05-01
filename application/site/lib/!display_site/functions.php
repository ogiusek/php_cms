<?php
namespace display_site;

// define route
$route = explode('?', $_SERVER['REQUEST_URI'])[0] ?? '/';
$route = $route[-1] == '/' && strlen($route) > 1 ? substr($route, 0, -1) : $route;

// get routes
$routes = \db\pages\get();
// format routes
$routes = array_map(function ($route) {
  $route['page'] = \format_link($route['page']);
  return $route;
}, $routes);

// add to file $pages_dir
$pages_directory = dirname(__DIR__, 2).'/pages';
$routes = \array_map(function ($route) use($pages_directory) {
  $route['file'] = "$pages_directory/".$route['file'];
  return $route;
}, $routes);

$matched_routes = array_filter($routes, function ($route_object) use ($route) {
  // $pattern = '(?<=\/)(\$[^\/]+)(?=\/|$)'; // matches $variable
  $variable_regex = '(?<=\/|)(\$\w*)(?=\/|$)'; // matches $ or $variable_name
  $variable_as_regex = '[a-zA-Z0-9]{0,}'; // replacement matches route
  $route_regex = str_replace('/', '\/', $route_object['page']);
  $route_regex = preg_replace("/$variable_regex/", "$variable_as_regex\\", $route_regex);
  $route_regex = $route_regex[-1] == "\\" ? substr($route_regex, 0, -1) : $route_regex;
  return preg_match("/^$route_regex$/", $route);
});
$matched_routes = array_values($matched_routes);

function route_do_not_exists() {
  global $routes, $route;
  $page = $routes[0]['page'];
  if($route != $page){
    header("Location: " . $page);
  }
  exit();
}

$GLOBALS['route'] = $route;
$GLOBALS['route_file'] = $matched_routes[0]['file']?? route_do_not_exists();
$GLOBALS['page_id'] = $matched_routes[0]['id']?? route_do_not_exists();

function load_head(){
  $page_id = $GLOBALS['page_id'];
  $content = \db\pages\head\get_by_page_id($page_id);
  $content->head->echo();
  $colors = $content->get_colors()->colors;
  echo "<style> :root {";
  foreach ($colors as $key => $value)
    echo "--color-$key: $value;\n";
  echo "} </style>";
}

function display_page() {
  ob_start();
  require $GLOBALS['route_file'];
  load_head();
  return ob_get_clean();
}

function get_and_remove_all_tags($tag, $html){
  $regex = "/<{$tag}>(.*?)<\/{$tag}>/s";
  $tags_content = "";
  if (preg_match_all($regex, $html, $matches)) {
    foreach ($matches[1] as $key => $value) {
      $tags_content .= "\n" . $value;
    }
    foreach ($matches[0] as $key => $value) {
      $html = str_replace($value, "", $html);
    }
  }
  return ["html" => $html, "value" => $tags_content];
}

function move_tag_to(string $tag, string $target, string $html){
  $result = get_and_remove_all_tags($tag, $html);
  $html = $result["html"];
  $to_replace = "</$target>";
  $replace_with = "<$tag>" . $result["value"] . "</$tag></$target>";
  // $html = str_replace($to_replace, $replace_with, $html);
  $html = \str_replace_one($to_replace, $replace_with, $html);
  return $html;
}

function load_all_files($dir, $extension){
  $dir_to_scan = dirname(__DIR__, 4) . "/$dir";
  $files = scandir($dir_to_scan);
  $files = array_diff($files, array('.', '..'));
  $text = "";
  foreach ($files as $file){
    if(\is_dir("$dir_to_scan/$file")){
      $text .= load_all_files("$dir/$file", $extension);
    }else if(\pathinfo($file, PATHINFO_EXTENSION) == $extension){
      $text .= "\n".file_get_contents("$dir_to_scan/$file");
    }
  }
  return $text;
}


function move_all_tags($html){
  $actions = [
    function ($html) { return move_tag_to("head", "head", $html); },
    function ($html) {
      // return move_tag_to("script", "body", $html);
      $js = get_and_remove_all_tags("script", $html);
      $js['value'] = load_all_files("static/js", "js")."\n".$js['value'];
      $_SESSION["js"] = $js["value"];
      $html = $js["html"];
      $html = \str_replace_one("</head>", "<script src=\"/api/compress/js?v=".time()."\" defer=\"true\"></script></head>", $html);
      // $html = \str_replace_one("</head>", "<script>".$js["value"]."</script></script></head>", $html);
      return $html;
    },
    function ($html) {
      // return move_tag_to("style", "head", $html);
      $css = get_and_remove_all_tags("style", $html);
      $css['value'] = load_all_files("static/css", "css") . "\n" . $css['value'];
      $_SESSION["css"] = $css["value"];
      $html = $css["html"];
      // $html = \str_replace_one("</head>", "<link rel=\"stylesheet\" href=\"/api/compress/css?v=".time()."\" defer=\"true\"></head>", $html);
      $html = \str_replace_one("</head>", "<style>".$css["value"]."</style></head>", $html);
      return $html;
    },
  ];

  foreach ($actions as $action) {
    $html = $action($html);
  }

  return $html;
}