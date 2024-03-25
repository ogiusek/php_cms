<?php
require_once "functions.php";
function display_site($html) {
  $html = display_site\move_all_tags($html);
  return $html;
}

function display_page() {
  return \display_site\display_page();
}