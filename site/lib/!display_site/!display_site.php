<?php
  require_once "functions.php";
  function display_site($html) {
    $html = display_site\move_all_tags($html);
    return $html;
  }