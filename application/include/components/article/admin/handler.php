<?php
$content = \components()->get_content();
$component = \components()->get_instance("article");

$component->text = \components()->form_handler("text", $content["text"] ?? []);

return $component;