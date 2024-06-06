<?php
$dir = __DIR__;
$files = scandir($dir);
foreach ($files as $path) {
  $file = "$dir/$path";
  $file = "$file/$path.php";
  if (file_exists($file)) {
    require_once $file;
  }
}