<?php
\request\verify()
  ->require_url_params(["url", "color"]);

$file = $_ENV['STATIC'].$_GET['url'];
$svg = @file_get_contents($file);
header("Content-Type: image/svg+xml");
$color = $_GET['color'];
if($color !== ""){
  $svg = str_replace("#ffffff", $_GET['color'], $svg);
  $svg = str_replace("#000000", $_GET['color'], $svg);
}
echo $svg;
exit();