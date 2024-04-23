<?php
\request\verify()
  ->allowed_methods(["PATCH"])
  ->require_url_params(["id"]);

$content = \db\pages\content\get_by_id($_GET["id"])[0]["content"];
$class_name = get_class_of_serialized($content);
try{
  $data = \components()->form_handler($class_name, $_POST);
}catch(\Throwable $e){
  ob_clean();
  \request\response()
    ->setStatus(500)
    ->setContent($e->getMessage())
    ->send();
}

if(is_string($data) || get_class($data) != $class_name){
  \request\response()
    ->setStatus(500)
    ->setContent("Handler response is not of type $class_name: $data")
    ->send();
}

\db\pages\content\edit($_GET["id"], serialize($data));

\request\response()
  ->setContent("Edited successfully!")
  ->send();