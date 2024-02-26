<?php
session_start();
require_once "include/include.php";

$api_start = "/api";
if (substr($_SERVER['REQUEST_URI'], 0, strlen($api_start)) === $api_start) {
  require_once "controllers/index.php";
} else {
  require_once "site/include.php";
}
