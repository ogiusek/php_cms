<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("button.css");
$data = $content->get_type_data() ?? [];
?>

<button class="<?=$component->identifiers()?>" onclick="<?=$data["onclick"]??"" ?>">
  <?=$content->render_text()?>
</button>