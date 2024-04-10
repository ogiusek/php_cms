<?php
namespace request;
require_once "response.php";
require_once "verify.php";

function get(string $key) {
  global $_POST;
  return $_POST[$key] ?? null;
}