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

function get_class_of_serialized(mixed $serialized){
  if(!is_string($serialized)) return get_class($serialized);
  $splitted = explode(":", $serialized);
  if(count($splitted) < 3) return "";
  $class_name_length = $splitted[1];
  if(!is_numeric($class_name_length)) return "";
  $data =  $splitted[2];
  $class_name = substr($data, 1, $class_name_length);
  return $class_name;
}

function remove_shared_part_of_string(string $formated_string, string $shared_string){
  $len1 = strlen($formated_string);
  $len2 = strlen($shared_string);
  $i = 0;
  while ($i < $len1 && $i < $len2 && $formated_string[$i] === $shared_string[$i]) { $i++; }
  return substr($formated_string, $i);
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

function image_to_datauri($file) {
  if(!file_exists($file))
    return "";
  $encoded = base64_encode(file_get_contents($file));
  $data_type = mime_content_type($file);
  return "data:$data_type;base64,$encoded";
}

function format_link(string $link) {
  $link = strtolower($link);
  // turn spaces and _ into -
  // remove special characters
  $link = preg_replace('/[\s_]/', '-', $link);
  $link = preg_replace('/[^a-zA-Z0-9\-\/.*]/', '', $link);
  // remove - at the beginning and at the end
  // remove double -
  $link = implode('/', array_map(function ($link) { return trim($link, '-'); }, explode('/', $link)));
  while (strpos($link, '--') !== false)
    $link = str_replace('--', '-', $link);
  // sort / characters
  // remove - at the beginning and at the end
  $link = trim($link, '/');
  $link = "/$link";
  return $link;
}

function array_flat(array $array) {
  $result = [];
  foreach ($array as $key => $value) {
    if (is_array($value)) {
      $result = array_merge($result, array_flat($value));
    } else {
      if(is_numeric($key)) $result[] = $value;
      if(!is_numeric($key)) $result[$key] = $value;
    }
  }
  return $result;
}