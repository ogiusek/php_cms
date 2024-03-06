<?php
namespace css;

class ICSS {
  private string $css = "";

  public function echo(): void {
    echo "<style>$this->css</style>";
  }

  private function wrap_selector(string $id, string $class, string $selector){
    // .component.component-1 h2:not(.component-1 .component h2)
    // return ".$class.$id $selector:not(.$id .$class $selector)"; // if someone knows why this works please let me know 
    return ".$id *:not(.$class)>$selector,
            .$id>$selector";
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
    $this->load_css(file_get_contents($path));
    return $this;
  }
}