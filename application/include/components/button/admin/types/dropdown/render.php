<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("dropdown.css")
  ->js_file("dropdown.js");
$data = $content->get_type_data();
// children
?>

<div class="<?=$component->identifiers()?>" data-refresh="admin_button_dropdown">
  <div class="input">
    <button class="add" onclick="admin_button_add_dropdown(this)">add</button>
  </div>
  <ul>
    <?php $children = $data["children"] ?? []; ?>
    <?php foreach($children as $child) { ?>
      <li class="li" data-name="children[]">
        <div class="input buttons">
          <button type="button" data-alt="toggle" class="toggle" onclick="select_parent_where(this, (e) => e.classList.contains('li')).classList.toggle('show');">
            <div style="width: 1rem">
              <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/dropdown.svg")->set_alt("toggle"))?>
            </div>
          </button>
          <button type="button" data-alt="remove" class="remove" onclick="select_parent_where(this, (e) => e.classList.contains('li')).remove();">
            <div style="width: 1rem">
              <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/trash.svg")->set_alt("remove"))?>
            </div>
          </button>
        </div>
        <div class="content">
          <?=\components()->admin_render($child)?>
        </div>
      </li>
    <?php } ?>
  </ul>
</div>