<?php
function wrap_admin($content) {
  $component = \component(__DIR__)
    ->css_file("admin_wrapper.css")
    ->js_file("admin_wrapper.js");
?>
  <main class="<?=$component->identifiers()?>">
    <div class="header">
      <?php require_once "header/header.php"; ?>
    </div>
    <div class="content">
      <?=$content?>
    </div>
  </main>
<?php } ?>