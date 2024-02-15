<?php
  require_once "site/display_site/index.php";
  function display_site($html, $app_content) {
    $html = display_site\replace_app_with_app_content($html, $app_content);
    $html = display_site\move_all_tags($html);
    return $html;
  }