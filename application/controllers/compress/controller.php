<?php
\request\verify()
  ->allowed_methods(["GET"])
  ->require_url_params(["url"]);

$file = $_ENV['STATIC'].urldecode($_GET['url']??"");
if(file_exists($file)){
  $file_extension = pathinfo($file, PATHINFO_EXTENSION);
  if($file_extension === "js") $file_extension = "javascript";
  header("Content-Type: text/$file_extension");
  echo file_get_contents($file);
}else{
  header("HTTP/1.0 404 Not Found");
}
