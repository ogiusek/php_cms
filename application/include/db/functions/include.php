<?php
$dir = __DIR__;
$files = scandir($dir);
foreach ($files as $path) {
  $directory = "$dir/$path";
  $file = "$directory/$path.php";
  if (is_dir($directory) && 
      file_exists($file)) {
    require_once $file;
  }
}