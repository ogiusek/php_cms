<?php
$content = \components()->get_content();
$component = \component(__DIR__);
?>

<div class="<?=$component->identifiers()?>">
  <div data-name="text">
    <?= \components()->admin_render($content->text ?? \components()->get_instance("text")) ?>
  </div>
  <!-- <div class="input">
    <label for="title">Title</label>
    <input type="text" data-name="title" value="<=$content->title?>" aria-label="title" required>
  </div>
  <div class="input">
    <label for="content">Content</label>
    <textarea data-name="content" rows="3" aria-label="content" required><=$content->content?></textarea>
  </div> -->
</div>