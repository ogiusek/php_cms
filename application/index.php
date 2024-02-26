<?php
if($_ENV['DEBUG']) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}
session_start();
require_once "include/include.php";

$api_start = "/api";
if (substr($_SERVER['REQUEST_URI'], 0, strlen($api_start)) === $api_start) {
  require_once "controllers/index.php";
} else {
  require_once "site/include.php";
}
