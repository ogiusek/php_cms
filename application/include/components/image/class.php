<?php
namespace components;

class image{
  private bool $show_settings = true;
  public function get_show_settings(){
    return $this->show_settings;
  }
  public function set_show_settings(bool $show_settings){
    $this->show_settings = $show_settings;
    return $this;
  }

  public string $image = '';
  public function get_src(){
    return $this->image??"";
  }
  
  public function set_src($image){
    $this->image = $image;
    return $this;
  }

  private string $alt = 'image cannot load';
  public function get_alt(){
    return $this->alt?? 'image cannot load';
  }
  public function set_alt(string $alt){
    $this->alt = $alt;
    return $this;
  }

  private array $style = [];
  public function get_style(){
    return $this->style;
  }
  public function set_style(array $style){
    $this->style = $style;
    return $this;
  }
  public function add_style(string $key, string $value){
    $this->style[$key] = $value;
    return $this;
  }

  public function __construct(){
    $this->image = "";
    $this->alt = 'image cannot load';
  }
};