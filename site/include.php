<?php
  require_once dirname(realpath(__DIR__)) . '/include/include.php';

  require_once "lib/include.php";         // user functions
  require_once "components/include.php";  // user components

  ob_start();
  // $scss
  display_component(); // renders example component
  // require_once "pages/include.php"; // renders current page
  $app_content = ob_get_clean();
  
  $html = file_get_contents(__DIR__ . "/index.html");
  echo display_site($html, $app_content);