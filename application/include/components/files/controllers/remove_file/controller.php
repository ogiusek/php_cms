<?php
\request\verify()
  ->require_session_token()
  ->require_params(["path"]);

$file = $_ENV['STATIC'].$_POST['path'];
unlink($file);

echo "success";
