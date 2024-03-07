<?php
function str_replace_one(string $search, string $replace, string $originalString) {
  $position = strpos($originalString, $search);
  
  if ($position !== false) {
    $newString = substr_replace($originalString, $replace, $position, strlen($search));
    return $newString;
  } else {
    return $originalString;
  }
}

function initialize_class_from_string(string $class_name){
  $ref = new \ReflectionClass($class_name);
  return $ref->newInstance();
}

function get_class_of_serialized(string $serialized){
  $splitted = explode(":", $serialized);
  if(count($splitted) < 3) return "";
  $class_name_length = $splitted[1];
  if(!is_numeric($class_name_length)) return "";
  $data =  $splitted[2];
  $class_name = substr($data, 1, $class_name_length);
  return $class_name;
}

function remove_shared_part_of_string(string $string1, string $string2){
  $len1 = strlen($string1);
  $len2 = strlen($string2);
  $i = 0;
  while ($i < $len1 && $i < $len2 && $string1[$i] === $string2[$i]) { $i++; }
  return substr($string1, $i);
}

function ceasar_cipher(string $string, int $key) {
  $key = $key % 26;
  $result = "";
  for ($i = 0; $i < strlen($string); $i++) {
    $char = $string[$i];
    if (ctype_alpha($char)) {
      if (ctype_upper($char)) {
        $char = chr(((ord($char) + $key - 65) % 26) + 65);
      } else {
        $char = chr(((ord($char) + $key - 97) % 26) + 97);
      }
    }
    $result .= $char;
  }
  return $result;
}
