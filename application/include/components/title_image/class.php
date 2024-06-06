<?php
namespace components;

\components()->load_class("image");
\components()->load_class("text");
class title_image{
  public object $image;
  public object $text;

  public function __construct(){
    $this->image = \components()->get_instance('image');
    $this->text = \components()->get_instance('text');
  }
};