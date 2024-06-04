<?php
$content = \components()->get_content();
$component = \components()->get_instance("button");

$component->set_text(\components()->form_handler("text", $content["text"] ?? []));
$content_type = $content["type"] ?? "button";
$component->set_type($content_type);

$handlers = [
  "link" => function (array $data){
    return $data;
  },
  "button" => function (array $data){
    return $data;
  },
  "dropdown" => function (array $data){
    $new_data = ["children" => []];
    $children = $data["children[]"] ?? [];
    foreach($children as $child){
      $new_data["children"][] = \components()->form_handler("button", $child);
    }
    return $new_data;
  }
];

$component->set_type_data($handlers[$content_type]($content["types"][$content_type] ?? []));

return $component;