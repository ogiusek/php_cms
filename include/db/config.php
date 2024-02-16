<?php
  $DB_ADDRESS = $_ENV["DB_ADDRESS"];
  $DB_DATABASE = $_ENV["DB_DATABASE"];
  $DB_USER = $_ENV["DB_USER"];
  $DB_PASSWORD = $_ENV["DB_PASSWORD"];

  // Create connection
  try{
    $GLOBALS['mysql'] = new mysqli($DB_ADDRESS, $DB_USER, $DB_PASSWORD, $DB_DATABASE);
    $GLOBALS['mysql']->set_charset("utf8");
  }catch (Exception $e){
    echo "Wrong db credentials: <br>";
    echo $e->getMessage();
    exit(1);
  }

  require_once "init.tables.php";