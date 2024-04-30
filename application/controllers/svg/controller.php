<?php
\request\verify()
  ->require_url_params(["url", "color"]);

function is_svg($file) {
  return preg_match('/\.svg$/i', $file);
}

$file = $_ENV['STATIC'].$_GET['url'];
if(!file_exists($file)){
  header("HTTP/1.0 404 Not Found");
  exit();
}
// if not svg just send it
if(!is_svg($file)){
  $extension = pathinfo($file, PATHINFO_EXTENSION);
  header("Content-Type: image/$extension");
  echo file_get_contents($file);
  exit();
}
$svg = @file_get_contents($file);
header("Content-Type: image/svg+xml");
$color = $_GET['color'];
if($color !== ""){
  $svg = str_replace("#ffffff", $_GET['color'], $svg);
  $svg = str_replace("#000000", $_GET['color'], $svg);
}
echo $svg;
exit();