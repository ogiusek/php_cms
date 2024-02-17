<?php
require_once "scssphp/scss.inc.php"; // use new ScssPhp\ScssPhp\Compiler(); .compileString('')->getCss();
require_once "classes.php";

$scss_compiler = new ScssPhp\ScssPhp\Compiler();

function compileScss($scss) {
  global $scss_compiler;
  $css = $scss_compiler->compileString($scss)->getCss();
  return $css;
}

function getWrappedScss($scss, $component_unique_class, $global_style = "") {
  $component_class = getComponentClass();
  $wrapped_scss = "$global_style \n .$component_unique_class :not(.$component_class), .$component_unique_class> { $scss }";
  return $wrapped_scss;
}

function getComponentCss($dir, $component_unique_class) {
  $component_scss_file = "$dir/component.module.scss";
  $component_scss = is_file($component_scss_file)? file_get_contents($component_scss_file) : "";
  
  $component_global_scss_file = "$dir/component.scss";
  $component_global_scss = is_file($component_global_scss_file)? file_get_contents($component_global_scss_file) : "";
  $component_global_scss = str_replace('component', $component_unique_class, $component_global_scss);
  // str_replace('component', $component_unique_class, $component_global_scss);

  $component_css = 
    ($component_scss . $component_global_scss) == "" ? "":
    compileScss(getWrappedScss($component_scss, $component_unique_class, $component_global_scss));

  return "<style>$component_css</style>";
}