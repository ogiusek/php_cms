<?php
class Obj {
  public array $data = [];

  public function __get($name){
    if(isset($this->data[$name])){
      return $this->data[$name];
    }
  }

  public function __set($name, $value){
    $this->data[$name] = $value;
  }
  public function __construct() {}
}