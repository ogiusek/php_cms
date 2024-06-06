<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("footer.css");
?>

<footer class="<?=$component->identifiers()?>">
  <div class="icon">
    <?=\components()->render($content->icon)?>
  </div>
  <div class="text">
    <?=\components()->render($content->text)?>
  </div>
  <div class="link">
    <a href="https://github.com/ogiusek/php_cms" target="_blank">Created with cms</a>
  </div>
</footer>