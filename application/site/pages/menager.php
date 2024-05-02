<?php
$page_id = $GLOBALS['page_id'];
$page_contents = \db\pages\content\get_by_page_id($page_id);

foreach($page_contents as $page_content){
  echo \components()
    ->render($page_content['content']);
}
