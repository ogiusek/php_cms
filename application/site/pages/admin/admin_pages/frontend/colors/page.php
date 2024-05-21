<?php
$component = \component(__DIR__)
  ->css_file("colors.css")
  ->js_file("colors.js");
?>

<section class="<?=$component->identifiers()?>">
  <form action="javascript:add_color(`<?=$component->css_id()?>`)" id="create-color-<?=$component->css_id()?>" class="create-form form">
    <div class="input">
      <h2>Create color palette</h2>
    </div>
    <div class="input">
      <input type="text" placeholder="color palette name" name="name" aria-label="class_name"
        maxlength="255" title="class handled by functions" autocomplete="off" required>
    </div>
    <div class="input">
      <button type="submit">Create</button>
    </div>
  </form>
  <?=\components()->render(\components()->get_instance("admin_colors_form"));?>
</section>