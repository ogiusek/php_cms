<?php
$component = \component(__DIR__);
?>
<section class="<?=$component->identifiers()?>">
  <h1>Files</h1>
  <?=\components()->render(\components()->get_instance("files"))?>
</section>
