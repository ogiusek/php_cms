<?php
namespace auto_admin;

function admin_handle(string $class_name, array $content): object{
  $instance = \components()->get_instance($class_name, $content);
  $class_vars = class_to_vars_types($instance);

  foreach($class_vars as $key => $type){
    $value = $content[$key] ?? null;
    // "array",
    // "object",
    // "resource",
    // "NULL",
    $default_types = [
      "string",
      "integer",
      "double",
      "float",
      "boolean",
    ];
    if(!in_array($type, $default_types) && is_string($type)){
      $instance->{$key} = $value;
      continue;
    }
    if(!is_array($type)){
      $instance->{$key} = \components()->form_handler($type, $instance->{$key});
      continue;
    }
    if(is_array($type)){
      // foreach($type as $i => $single_type){ // WRONG
      //   $instance->{$key}[] = \components()->form_handler($single_type, $value[$i] ?? null);
      // }
      continue;
    }
  }

  return $instance;
}
