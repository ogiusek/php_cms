<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("admin_colors_form.css")
  ->js_file("admin_colors_form.js");

$color_paletts = \db\colors\get();
?><ul class="<?=$component->identifiers()?>" data-refresh="admin_colors_form">
<?php foreach($color_paletts as $color_palette) { ?>
  <li class="color-palette" data-id="<?=$color_palette->id?>">
    <form action="javascript:edit_color_palette(<?=$color_palette->id?>)" class="form edit-form">
      <div class="input">
        <label for="name">name</label>
        <input type="text" name="name" data-name="name" aria-label="name" required maxlength="255" value="<?=$color_palette->name?>">
      </div>
      <div class="colors" data-name="colors">
      <?php foreach($color_palette->colors as $color_name => $color) { ?>
        <button
          type="button" onclick="this.querySelector('input').select();"
          class="color" style="background-color: <?=$color?>" data-color="<?=$color?>">
          <label name="color"><?=$color_name?></label>
          <input type="color" data-name="<?=$color_name?>" aria-label="color" value="<?=$color?>" onchange="update_color(this)">
        </button>
      <?php } ?>
      </div>
      <div class="input button" style="margin-left: auto;justify-content: flex-end">
        <button type="submit" data-alt="save">
          <div style="width: 1rem;">
            <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/save.svg")->set_alt("save"))?>
          </div>
        </button>
        <button type="button" data-alt="remove" class="remove" onclick="remove_color_palette(<?=$color_palette->id?>)">
          <div style="width: 1rem;">  
            <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/trash.svg")->set_alt("remove"))?>
          </div>
        </button>
      </div>
    </form>
  </li>
<?php } ?>
</ul>

