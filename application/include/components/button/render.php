<?php
$content = \components()->get_content();
$type = $content->get_type()->value;
require "types/$type/render.php";
