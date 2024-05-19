<?php
$page_id = $_SESSION['page_id'];
$page_contents = \db\pages\content\get_by_page_id($page_id);

foreach($page_contents as $page_content){
  echo \components()
    ->render($page_content['content']);
}

// use Jefs42\LibreTranslate;
// $translator = new LibreTranslate();
// echo $translator->translate("Hello World", "en", "es");