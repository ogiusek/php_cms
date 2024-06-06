<?php
namespace css;

class ICSS {
  private string $css = "";
  // private bool $is_shown = false;

  public function echo(): void {
    // if($this->is_shown) return;
    // $this->is_shown = true;
    if($this->css == "") return;
    echo "<style>$this->css</style>";
    $this->css = "";
  }

  private function wrap_selector(string $id, string $class, string $selector){
    return ".$id $selector:not(.$id .$class:not(.$id) $selector)"; // idk this works
    // but -> this can be better somethimes
    // is there any ready solution for this ?
    // css is the hardest programing language in the world
    // return ".$id *:not(.$class)>$selector:not(.$class),
    //         .$id>$selector:not(.$class)";
  }

  private function change_selectors(string $id, string $class){
    $regex = "/:wrap\(((?:(?:[^()]*|(?<=\())\([^()]*\))*[^()]*)\)/";
    $this->css = \preg_replace_callback($regex, function($matches) use ($id, $class) {
      return $this->wrap_selector($id, $class, $matches[1]);
    }, $this->css);
  }

  private function replace(string $old, string $new){ $this->css = \str_replace($old, $new, $this->css); }
  private function replace_id(string $id){ $this->replace('#id', ".$id"); }
  private function replace_class(string $class){ $this->replace('.class', ".$class"); }

  public function format(string $id, string $class): self {
    $this->change_selectors($id, $class);
    $this->replace_id($id);
    $this->replace_class($class);
    return $this;
  }

  public function load_css($css): self {
    $this->css .= $css;
    return $this;
  }

  public function load_css_from_path($path): self {
    static $paths = [];
    if(isset($paths[$path])) return $this;
    $paths[$path] = true;
    $this->load_css(file_get_contents($path));
    return $this;
  }
}