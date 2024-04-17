<?php
require_once "include.php";

$path = str_replace("/api", __DIR__, $_SERVER['REQUEST_URI']);
$path = explode("?", $path, 2)[0];
$file = "$path/controller.php";
if(!file_exists($file)) {
  request\response()
    ->setStatus(404)
    ->setContent($_SERVER['REQUEST_URI'] . " not found")
    ->send();
}

$success = @require_once $file;
if(!$success)
  request\response()
    ->setStatus(500)
    ->setContent("Error: " . error_get_last()['message'])
    ->send();

// try{
//   @require_once $file;
// }catch(Throwable $e){
//   request\response()
//     ->setStatus(500)
//     ->setContent("Error: " . $e->getMessage())
//     ->send();
// }