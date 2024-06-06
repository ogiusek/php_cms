<?php
$content = \components()->get_content();
$component = \component(__DIR__);
?>

<div>
  <div data-name="icon">
    <?=\components()->admin_render($content->icon)?>
  </div>
  <div data-name="text">
    <?=\components()->admin_render($content->text)?>
  </div>
</div>