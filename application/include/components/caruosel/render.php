<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("caruosel.css")
  ->js_file("caruosel.js");
?>

<section class="<?=$component->identifiers()?> caruosel">
  <ul class="slides" data-loaded-js="0">
    <?php foreach($content->slides as $key => $slide) { ?>
      <li class="slide <?php if($key == 0) echo "active"; ?>">
        <div class="controls">
          <button type="button" class="left">
            <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/left.svg")->set_alt("left"))?>
          </button>
          <button type="button" class="right">
            <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/right.svg")->set_alt("right"))?>
          </button>
        </div>
        <div class="bg">
          <?=\components()->render($slide["image"] ?? \components()->get_instance("image"))?>
        </div>
        <div class="text">
          <?=\components()->render($slide["text"] ?? \components()->get_instance("text"))?>
        </div>
      </li>
    <?php } ?>
  </ul>
</section>