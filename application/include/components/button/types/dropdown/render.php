<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("dropdown.css");
$data = $content->get_type_data() ?? [];
?>

<div class="<?=$component->identifiers()?>">
  <button class="dropdown-button">
    <div class="dropdown-text">
      <?=$content->render_text()?>
    </div>
    <div class="dropdown-icon">
      <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/dropdown.svg")->set_alt("dropdown"))?>
    </div>
  </button>
  <ul class="dropdown">
    <?php $children = $data["children"] ?? [];?>
    <?php foreach($children as $child) { ?>
      <li>
        <?=\components()->render($child)?>
      </li>
    <?php }?>
  </ul>
</div>