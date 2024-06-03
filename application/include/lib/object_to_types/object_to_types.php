<?php
function get_type(mixed $var){
  if(is_object($var)) return get_class($var);
  return gettype($var);
}

function class_to_vars_types(object $instance) {
  $class_name = get_class($instance);
  $vars = get_object_vars($instance);

  $types = array_map(function($key, $value) use($class_name) {
    $empty_response = [];
    $type = get_type($value);
    if($type === "array"){
      if (!method_exists($class_name, $key."_type"))
        return $empty_response;
      $type = call_user_func([$class_name, $key.'_type']);
      if(!is_array($type))
        return $empty_response;
      if(count(array_filter($type, function($element) { return get_type($element) !== "string"; })) > 0)
        return $empty_response;
    }
    return [$key => $type];
  }, array_keys($vars), array_values($vars));
  $types = array_merge(...$types);
  return $types;
}