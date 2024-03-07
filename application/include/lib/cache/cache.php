<?php
  function cache_get($key, $default_value) {
    $file_name = ".cache/$key";
    if (file_exists($file_name))
      return unserialize(file_get_contents($file_name));
    return $default_value;
  }
  
  function cache_set($key, $value) {
    $file_name = ".cache/$key";
    file_put_contents($file_name, serialize($value));
  }