<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->js_file("header.js")
  ->css_file("header.css");
?>

<div class="<?=$component->identifiers()?>" data-refresh="header">
  <div class="input" data-name="logo">
    <!-- <=\components()->admin_render(\components()->get_instance("image")->set_src($content->logo)->set_alt("logo"))?> -->
    <?=\components()->admin_render(\components()->get_instance("image")->set_src($content->logo))?>
  </div>
  <h3>dropdowns</h3>
  <div class="input">
    <button onclick="add_to_header_component_dropdown(this)" class="add">add</button>
  </div>
  <ul>
    <?php foreach ($content->dropdowns as $dropdown) { ?>
      <li data-name="dropdown[]" class="li">
        <div class="input" style="display: flex; flex-direction: row; gap: 1rem;">
          <button class="toggle" data-alt="toggle" onclick="select_parent_where(this, (e) => e.classList.contains('li'))
            .querySelector('.toggle-content').classList.toggle('hidden')">
            <div style="width: 1rem">
              <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/dropdown.svg")->set_alt("toggle"))?>
            </div>
          </button>
          <button onclick="this.parentElement.parentElement.remove()" class="remove">
            <div style="width: 1rem">
              <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/trash.svg")->set_alt("remove"))?>
            </div>
          </button>
        </div>
        <div class="toggle-content hidden">
          <?= \components()->admin_render($dropdown) ?>
        </div>
      </li>
    <?php } ?>
  </ul>
</div>