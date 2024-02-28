<?php
$db = mysqli_connect(
  $_ENV["DB_ADDRESS"],
  $_ENV["DB_USER"],
  $_ENV["DB_PASSWORD"],
  $_ENV["DB_DATABASE"]
);

if (!$db) {
  echo "Wrong db credentials: <br>";
  echo mysqli_connect_error();
  exit(1);
}
mysqli_set_charset($db, "utf8");
$GLOBALS["db"] = &$db;

require_once "basic_functions.php";
require_once "functions/include.php";

if($_ENV["LOAD_DEFAULT_DATABASE_CONFIG"])
  require_once "init.tables.php";