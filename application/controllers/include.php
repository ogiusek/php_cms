<?php
switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    $_POST = &$_GET;
    break;
  case 'POST':
  case 'PUT':
  case 'DELETE':
  case 'PATCH':
    $_POST = json_decode(file_get_contents('php://input'), true);
    break;
  default:
    // ignore
    break;
}

require_once "!lib/include.php";