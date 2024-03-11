<?php
if($_ENV['DEBUG']) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL & ~E_NOTICE);
}
session_start();
ob_start();
require_once "include/include.php";

$api_start = "/api";
if (substr($_SERVER['REQUEST_URI'], 0, strlen($api_start)) === $api_start) {
  require_once "controllers/index.php";
} else {
  require_once "site/include.php";
}
$content = ob_get_clean();

// check do browser support gzip
if(isset($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false) ) {
  $content = gzencode($content, 9);
  header("Content-Encoding: gzip");
}

echo $content;