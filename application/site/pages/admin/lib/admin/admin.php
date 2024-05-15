<?php
require_once "namespace.php";
function admin(): \admin\IAdmin {
  static $admin = new \admin\IAdmin();
  return $admin;
}
