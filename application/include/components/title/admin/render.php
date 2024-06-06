<?php
$content = \components()->get_content();
$component = \component(__DIR__);
?>

<div class="<?=$component->identifiers()?>">
  <div class="input">
    <label for="title">Title</label>
    <input type="text" data-name="title" value="<?=$content->title?>" aria-label="title" required>
  </div>
</div>