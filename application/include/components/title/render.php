<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("title.css");
?>

<h1 class="<?=$component->identifiers()?>"><?=$content->title?></h1>