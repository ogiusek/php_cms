<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("header.css");
?>

<header class="<?=$component->identifiers()?>" data-refresh="header">
  <div class="icon-parent">
    <?= \components()->render(\components()->get_instance("image")->set_src("/".$content->logo)->set_alt("logo"))?>
  </div>
  <div class="dropdowns hide">
    <?php foreach ($content->dropdowns as $dropdown) { ?>
      <?=\components()->render($dropdown)?>
    <?php } ?>
  </div>
  <button class="toggle_dropdowns icon-parent" onclick="this.parentElement.querySelector('.dropdowns').classList.toggle('hide')">
    <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/menu.svg")->set_alt("menu"))?>
  </button>
</header>