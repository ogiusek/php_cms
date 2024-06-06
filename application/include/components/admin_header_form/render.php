<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("admin_header_form.css")
  ->js_file("admin_header_form.js");
$head = \db\pages\head\get_by_page_id($content->page_id);
$color_palette_id = $head->color_palette_id;
?>

<div class="<?=$component->identifiers()?>">
  <h2>Page head</h2>
  <form action="javascript:edit_head(<?=$content->page_id?>)" class="form edit-form" id="edit-head-form-<?=$content->page_id?>">
    <div class="input">
      <label for="title">title</label>
      <input type="text" data-name="title" value="<?=$head->head->title?>" aria-label="title" required>
    </div>
    <div class="input">
      <label for="description">description</label>
      <input type="text" data-name="description" value="<?=$head->head->description?>" aria-label="description" required>
    </div>
    <div class="input">
      <label for="keywords">keywords</label>
      <input type="text" data-name="keywords" value="<?=$head->head->keywords?>" aria-label="keywords" required>
    </div>
    <div class="input">
      <label for="color-palette">color palette</label>
      <select data-name="color_palette" aria-label="color-palette">
        <?php 
        $colors = \db\colors\get();
        foreach($colors as $color) { ?>
        <option value="<?=$color->id?>" <?= $color->id === $color_palette_id ? "selected" : "" ?>><?=$color->name?></option>
        <?php } ?>
      </select>
    </div>
    <div class="input" data-name="icon">
      <label for="icon">icon</label>
      <?=\components()->admin_render(\components()->get_instance("image")->set_src($head->head->icon)->set_alt("icon")->set_show_settings(false))?>
    </div>
    <div class="input" data-name="image">
      <label for="image">image</label>
      <?=\components()->admin_render(\components()->get_instance("image")->set_src($head->head->image)->set_alt("image")->set_show_settings(false))?>
    </div>
    <div class="input button">
      <button type="submit" data-alt="save">
        <div style="width: 1rem">
          <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/save.svg")->set_alt("save"))?>
        </div>
      </button>
    </div>
  </form>
</div>