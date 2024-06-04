<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("button.css")
  ->js_file("button.js");
?>

<div class="<?=$component->identifiers()?>" data-refresh="button">
  <div class="text" data-name="text">
    <?=\components()->admin_render($content->get_text())?>
  </div>
  <div class="type">
    <?php $types = ["button", "link", "dropdown"] ?>
    <div class="input">
      <label for="type">button type</label>
      <select data-name="type" onchange="admin_button_select_type(this)" aria-label="type">
        <?php foreach($types as $type) {?>
          <option value="<?=$type?>" <?= $content->get_type()->value === $type ? "selected":"" ?>><?=$type?></option>
        <?php }?>
      </select>
    </div>
    <div data-name="types" data-information-type="<?=$content->get_type()->value?>">
    <?php \components()->set_content($content)?>
      <?php foreach($types as $type){?>
        <div class="types <?=$type == $content->get_type()->value ? "show":"" ?>" data-name="<?=$type?>">
          <?php require "types/$type/render.php"; ?>
        </div>
      <?php }?>
    </div>
  </div>
</div>
