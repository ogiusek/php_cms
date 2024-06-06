<?php
$content = \components()->get_content();
$component = \components()->get_instance("title_image");

$component->image = \components()->form_handler("image", $content['image']??[]);
$component->text = \components()->form_handler("text", $content['text']??[]);

return $component;