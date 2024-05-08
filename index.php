<?php
// echo phpversion(); // requires PHP >= 8.1
$_ENV["STATIC"] = __DIR__."/static";
if(file_exists(__DIR__."/env.php"))
  include "env.php";
require_once "application/index.php";

// if you do not have account create one with line below
if(
  isset($_ENV["ROOT_EMAIL"]) &&
  isset($_ENV["ROOT_PASSWORD"])
)
  \db\user\create_account(
    $_ENV["ROOT_EMAIL"],
    $_ENV["ROOT_PASSWORD"]
  );
  // \db\user\create_account("try@gmail.com", "password"); // <----------------------------------------------