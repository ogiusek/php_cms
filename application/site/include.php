<?php
function logToConsole(...$args) {
  if(!$_ENV["DEBUG"]){
    return;
  }
  $args = array_map(function ($arg) { return json_encode($arg); }, $args);
  $args = implode(",", $args);
  echo "<script>console.log($args)</script>";
}
ob_start();
require_once __DIR__ . "/index.php";
$html = ob_get_clean();
$html = \display_site($html);

echo $html;
