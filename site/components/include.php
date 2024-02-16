<?php
$dir = __DIR__;
$files = scandir($dir);
foreach ($files as $path) {
  $directory = "$dir/$path";
  $php_file = "$directory/$path.php";
  if (!is_dir($directory) || !file_exists($php_file)) {
    continue;
  }
  require_once $php_file;

  $js_file = "$directory/$path.js";
  if (file_exists($js_file)) {
    require_once $js_file;
  }
}
