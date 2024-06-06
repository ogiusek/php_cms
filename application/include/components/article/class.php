<?php
namespace components;

\components()->load_class("text");
class article{
  public object $text;
  public function __construct(){
    $this->text = \components()->get_instance("text");
  }
};