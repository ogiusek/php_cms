<?php
namespace components;

enum button_type: string {
  case link = "link";
  case button = "button";
  case dropdown = "dropdown";

  public static function default(): self {
    return self::link;
  }
};
\components()->load_class("text");
class button{
  private object $text;
  public function get_text(): object {
    return $this->text ?? \components()->get_instance("text");
  }
  public function set_text(mixed $text): self{
    $this->text = is_string($text) ?
      \components()->get_instance("text")->set_text($text) :
      $text;
    return $this;
  }
  public function render_text(){
    return \components()->render($this->get_text());

  }
  
  private button_type $type = button_type::link;
  private array $data = [];

  public function get_type(): button_type {
    return $this->type;
  }
  public function set_type(string $type, array $data = []): self{
    $this->type = button_type::from($type);
    $this->data = $data;
    return $this;
  }
  public function get_type_data(): array {
    return $this->data;
  }
  public function set_type_data(array $data): self{
    $this->data = $data;
    return $this;
  }

  public function __construct() {
    $this->text = \components()->get_instance("text");
  }
};