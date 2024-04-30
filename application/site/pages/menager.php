<?php
$page_id = $GLOBALS['page_id'];
$page_contents = \db\pages\content\get_by_page_id($page_id);

foreach($page_contents as $page_content){
  echo \components()
    ->render($page_content['content']);
}
?>
<!-- <textarea rows="10" cols="80">{\\rtf1\\ansi\\ansicpg1252\\deff0\\deflang1033{\\fonttbl{\\f0\\fnil\\fcharset0 Arial;}}\n
\\viewkind4\\uc1\\pard\\f0\\fs24 This is some editable RTF content in HTML.\\par\n
}</textarea> -->
