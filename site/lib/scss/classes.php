<?php
function getComponentClass() {
  static $class = "component-class";
  return $class;
}

function getUniqueComponentClass() {
  return getComponentClass() . "-" . getUniqueID();  
}