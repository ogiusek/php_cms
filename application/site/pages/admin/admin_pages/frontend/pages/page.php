<?php
$component = \component(__DIR__)
  ->css_file("pages.css")
  ->js_file("pages.js");
echo "<script>const pages_id = `".$component->css_id()."`;</script>";
?>

<section class="<?=$component->identifiers()?>">
  <form action="javascript:add_page(`<?=$component->css_id()?>`)" id="create-page-<?=$component->css_id()?>" class="create-form form">
    <div class="input">
      <h2>Create Page</h2>
    </div>
    <div class="input">
      <input type="text" placeholder="main page" class="page-name" name="page" aria-label="page name"
      maxlength="255" title="Page address" autocomplete="off" required>
    </div>
    <div class="input" style="display: none">
      <input type="text" placeholder="start/start.php" class="page-file" name="file" aria-label="page file"
      value="menager.php" maxlength="255" title="Path to file" required>
    </div>
    <div class="input" style="display: none">
      <input type="number" class="page-order" name="order" aria-label="page order" required
      value="0" title="Order" autocomplete="off">
    </div>
    <div class="input">
      <button type="submit">Create</button>
    </div>
  </form>
  <?=\components()->render(\components()->get_instance("admin_pages_form"))?>
</section>