<?php
namespace components;

class text{
  private string $text = "";
  public function get_html(){
    return $this->text;
  }
  public function set_html(string $text){
    $this->text = $text;
    return $this;
  }
  public function set_text(string $text){
    $this->text = $text;
    return $this; 
  }
};