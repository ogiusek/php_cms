<?php
$content = \components()->get_content();
$component = \components()->get_instance("header");

$image = \components()->form_handler("image", $content["logo"]);
$component->logo = $image->get_src();
$component->dropdowns = [];
foreach ($content["dropdown[]"] as $dropdown) {
  $component->dropdowns[] = serialize(\components()->form_handler("button", $dropdown));
}

return $component;