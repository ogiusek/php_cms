<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("title_image.css");
?>

<div class="<?=$component->identifiers()?>">
  <?= \components()->render($content->image ?? \components()->get_instance("image")) ?>
  <?php if($content->text || $content->title) { ?>
    <div class="container">
      <?=\components()->render($content->text ?? \components()->get_instance("text"))?>
    </div>
  <?php } ?>
</div>