<?php
require_once "namespace.php";

function head(){
  static $head = new \head\IHead();
  return $head;
}

// \head()->title("start?")
// \head()->{'title'}("start?") // this does the same as line above
// get_class_methods('\head\head'); // this shows all methods of \head\head