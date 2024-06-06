<?php
$content = \components()->get_content();
$component = \components()->get_instance("title");

$component->title = $content["title"] ?? $component->title;

return $component;