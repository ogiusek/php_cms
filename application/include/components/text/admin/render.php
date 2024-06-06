<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->js_file("text.js")
  ->css_file("text.css");
?>
<div class="<?=$component->identifiers()?>" data-refresh="text">
  <textarea data-name="html" class="rtf-textarea"><?=$content->get_html()?></textarea>
</div>