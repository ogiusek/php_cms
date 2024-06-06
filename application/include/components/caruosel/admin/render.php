<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("caruosel.css")
  ->js_file("caruosel.js");
?>

<div class="<?=$component->identifiers()?>" data-refresh="caruosel">
  <form action="javascript:void(0);" onsubmit="caruosel_admin_add_slide(this)">
    <div class="input">
      <button type="submit">add slide</button>
    </div>
  </form>
  <ul>
    <?php foreach($content->slides as $slide) { ?>
      <li data-name="slides[]" class="li">
        <div class="input buttons">
          <button type="button" data-alt="remove" class="remove" onclick="select_parent_where(this, (e) => e.classList.contains('li')).remove();">
            <div style="width: 1rem;">
              <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/trash.svg")->set_alt("remove"))?>
            </div>
          </button>
        </div>
        <div data-name="image">
          <?=\components()->admin_render($slide["image"] ?? \components()->get_instance("image"))?>
        </div>
        <div data-name="text">
          <?=\components()->admin_render($slide["text"] ?? \components()->get_instance("text"))?>
        </div>
      </li>
    <?php } ?>
  </ul>
</div>