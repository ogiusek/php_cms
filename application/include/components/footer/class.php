<?php
namespace components;

\components()->load_class("image")
              ->load_class("text");
class footer {
  public object $icon;
  public object $text;

  public function __construct() {
    $this->icon = \components()->get_instance("image");
    $this->text = \components()->get_instance("text");
  }
}