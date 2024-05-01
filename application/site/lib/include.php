<?php
$dir = __DIR__;
$files = scandir($dir);
$files = array_diff($files, array('.', '..'));
foreach ($files as $path) {
  $file = "$dir/$path/$path.php";
  if (file_exists($file)) {
    require_once $file;
  }
}