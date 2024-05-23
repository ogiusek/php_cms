<?php
$file_suffix = "page.php";

if($_SESSION['route'] == "/admin"){
  require_once "main_page/$file_suffix";
  return;
}
$route = $_SESSION['route'];
$route = str_replace("/admin/", "", $route);

$file = "$route/$file_suffix";
if(!file_exists(__DIR__."/$file")){
  header("Location: /admin");
  exit();
}

require_once "$file";
