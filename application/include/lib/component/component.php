<?php
require_once "css/css.php";
require_once "class.php";

function &component(string $dir): \component\IComponent {
  static $components = [];
  if (isset($components[$dir])) {
    return $components[$dir];
  }
  $components[$dir] = new \component\Component("$dir/");
  return $components[$dir];
}
