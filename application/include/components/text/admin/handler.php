<?php
$content = \components()->get_content();
$component = \components()->get_instance("text");

$component->set_html($content["html"] ?? $component->get_html());

return $component;