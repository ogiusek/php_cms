<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("article.css");
?>

<article class="<?=$component->identifiers()?>">
  <?= \components()->render($content->text ?? \components()->get_instance("text")) ?>
</article>