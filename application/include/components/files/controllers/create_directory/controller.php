<?php
\request\verify()
  ->require_session_token()
  ->require_params(["path", "directory_name"]);

$file = $_ENV['STATIC'];
$file .= $_POST['path']."/".$_POST['directory_name'];
mkdir($file);

echo "success";