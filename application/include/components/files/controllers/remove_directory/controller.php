<?php
\request\verify()
  ->require_session_token()
  ->require_params(["path"]);

$file = $_ENV['STATIC'].$_POST['path'];
$thrown_error = !@rmdir($file);

echo $thrown_error ? "directory is not empty" : "success";

