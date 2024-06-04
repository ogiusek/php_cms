<?php
$content = \components()->get_content();
$data = $content->get_type_data();
// href
?>
<div class="input">
  <label for="page">page</label>
  <select data-name="page-id">
    <?php
    $pages = \db\pages\get(true);
    foreach($pages as $page) { ?>
      <option value="<?=$page["id"]?>" <?=$data["page-id"]??"" === $page["id"] ? "selected":"" ?>><?=$page["page"]?></option>
    <?php } ?>
  </select>
  <!-- <label for="href">href</label>
  <input type="text" data-name="href" value="<=$data["href"]??""?>" aria-label="href"> -->
</div>