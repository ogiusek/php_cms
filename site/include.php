<?php
  require_once getcwd().'/include/include.php';

  // $html = file_get_contents(__DIR__ . "/index.html");
  require_once "lib/include.php";         // user functions
  require_once "components/include.php";  // user components
  ob_start();
  require_once __DIR__ . "/index.php";
  $html = ob_get_clean();

  // echo "<script>console.log(".json_encode($html).")</script>";
  echo display_site($html);