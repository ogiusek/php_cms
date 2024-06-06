<?php
namespace component;
require_once "interface.php";

function getUniqueID() {
  static $id = 0;
  return ++$id;
}

$component_class = "component-class";
$component_unique_class = "component-unique-class-";

class Component implements IComponent {
  private string $parent_dir = "";
  private string $id = "-1";
  private \css\ICSS $css;
  private array $shown_js = [];

  function js_file(string $path): self {
    if(in_array($path, $this->shown_js)) return $this;
    $this->shown_js[] = $path;

    $path = $this->parent_dir . $path;
    $js = file_get_contents($path);
    echo "<script>$js</script>";
    return $this;
  }

  function css_id(): string {
    global $component_unique_class;
    return $component_unique_class . $this->id;
  }

  function css_file(string $path): self {
    global $component_class;
    $path = $this->parent_dir . $path;
    $this->css
      ->load_css_from_path($path)
      ->format($this->css_id(), $component_class)
      ->echo();
    return $this;
  }

  function identifiers(): string {
    global $component_class;
    $class = "$component_class";
    $id = $this->css_id();
    return "$class $id";
  }

  function __construct(string $dir) {
    $this->parent_dir = $dir;
    $id = $dir;
    $id = remove_shared_part_of_string($id, __DIR__);
    $id = ceasar_cipher($id, 13);
    $this->id = str_replace("/", "-", $id); // $this->id = $dir;
    $this->css = \css();
  }
}