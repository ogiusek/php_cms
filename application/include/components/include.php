<?php
require_once "class.php";

/**
 * @return \components\IComponents
 */
function &components(): \components\IComponents {
  static $components;
  $components ??= new \components\ComponentsImplementation();
  return $components;
}