<?php
  namespace display_site;
  function replace_app_with_app_content($html, $app_content) {
    $div_id_regex = "/<div id=\"app\">(.*?)<\/div>/s";
    if (preg_match($div_id_regex, $html, $div)) {
      $html = str_replace($div[0], $app_content, $html);
    }
    return $html;
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
    return array("html" => $html, "value" => $tags_content);
  }

  function move_tag_to($tag, $target, $html){
    $result = get_and_remove_all_tags($tag, $html);
    $html = $result["html"];
    $html = str_replace("</$target>", "<$tag>" . $result["value"] . "</$tag></$target>", $html);
    return $html;
  }

  function move_all_tags($html){
    $actions = array(
      function ($html) { return move_tag_to("style", "head", $html); },
      function ($html) { return move_tag_to("script", "body", $html); },
      function ($html) { return move_tag_to("head", "head", $html); },
    );
    foreach ($actions as $action) {
      $html = $action($html);
    }
    return $html;
  }


  function get_functions($html){
    $function_regex = "/<DISPLAY::[a-zA-Z]+.*?\/>/";
    $function_regex = htmlspecialchars($function_regex);
    if (!preg_match_all($function_regex, $html, $functions)) {
      return array();
    }
    return $functions[0];
  }

  function get_function_name($function) {
    $function_name_regex = "/<DISPLAY::([a-zA-Z]+)/";
    $function_name_regex = htmlspecialchars($function_name_regex);

    preg_match($function_name_regex, $function, $function_name);
    return $function_name[1];
  }

  function get_function_action($function) {
    $function_action_regex = "/<DISPLAY::[a-zA-Z]+(.*)?\/>/";
    $function_action_regex = htmlspecialchars($function_action_regex);
    preg_match($function_action_regex, $function, $function_action);
    return $function_action[1];
  }
  
  function run_functions($html) {
    $functions = get_functions($html);
    foreach ($functions as $function) {
      $function_name = get_function_name($function);
      $function_action = get_function_action($function);
      $res = call_user_func($function_name, $function_action);
      $res = run_functions($res);
      // echo $html . "<br><br>";
      $html = str_replace($function, $res, $html);
      // echo $html . "<br><br>";
    }
    return $html;
  }