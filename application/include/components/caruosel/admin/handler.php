<?php
$content = \components()->get_content();
$component = \components()->get_instance("caruosel");

foreach(($content["slides[]"]??[]) as $slide) {
  $component->slides[] = [
    "text" => \components()->form_handler("text", $slide["text"] ?? []),
    "image" => \components()->form_handler("image", $slide["image"] ?? [])
  ];
}

return $component;