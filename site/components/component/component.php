<?php
function display_component(){
  static $component_class = null;
  static $component_unique_class = null;
  $component_class = $component_class?? getComponentClass();
  $component_unique_class = $component_unique_class?? getUniqueComponentClass();
?>
  <h1 class="<?= "$component_class $component_unique_class" ?>">works ?</h1>
<?php
  static $component_css = null;
  if($component_css == null){
    $component_css = getComponentCss(__DIR__, $component_unique_class);
    echo $component_css;
  }
}
?>