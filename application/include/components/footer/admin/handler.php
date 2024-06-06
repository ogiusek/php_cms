<?php
$content = \components()->get_content();
$component = \components()->get_instance("footer");

$component->icon = \components()->form_handler("image", $content["icon"] ?? []);
$component->text = \components()->form_handler("text", $content["text"] ?? []);

return $component;