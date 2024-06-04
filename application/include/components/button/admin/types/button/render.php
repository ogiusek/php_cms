<?php
$content = \components()->get_content();
$data = $content->get_type_data();
// onclick
?>
<div class="input">
  <label for="onclick">onclick</label>
  <input type="text" data-name="onclick" value="<?=$data["onclick"]??""?>" aria-label="onclick">
</div>