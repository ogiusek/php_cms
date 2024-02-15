<?php
  require_once dirname(realpath(__DIR__)) . '/include/include.php';
  require_once "site/display_site.php";

  ob_start();
  // require_once "lib/include.php";
  // require_once "components/include.php";
  // require_once "pages/include.php";
  echo "<h1>example site</h1>";
  echo "<style>h1{background-color: red;}</style>";
  echo "<style>div{background-color: green;}</style>";
  echo "<style>div{color: red;}</style>";
  echo "<style>div{padding: 10px;}</style>";
  echo "<style>h1{color: blue;}</style>";
  
  $app_content = ob_get_clean();
  
  $html = file_get_contents(__DIR__ . "/index.html");
  echo display_site($html, $app_content);
  
  // echo $res;