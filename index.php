<?php
// echo phpversion(); // requires PHP >= 8.1
if(file_exists(__DIR__."/env.php"))
  include "env.php";
$_ENV["STATIC"] = __DIR__."/static/";
require_once "application/index.php";


// create root account
if(isset($_ENV["ROOT_EMAIL"]) &&
   isset($_ENV["ROOT_PASSWORD"]))
  \db\user\create_account(
    $_ENV["ROOT_EMAIL"],
    $_ENV["ROOT_PASSWORD"]
  );