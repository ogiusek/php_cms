<?php
$content = \components()->get_content();
$component = \component(__DIR__);
?>

<div class="<?=$component->identifiers()?>">
  <div data-name="image">
    <?=\components()->admin_render($content->image ?? \components()->get_instance("image"));?>
  </div>
  <div data-name="text">
    <?=\components()->admin_render($content->text ?? \components()->get_instance("text"));?>
  </div>
</div>