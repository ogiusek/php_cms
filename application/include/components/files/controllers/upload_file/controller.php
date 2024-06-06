<?php
\request\verify()
  ->require_session_token()
  ->require_params(["file_name", "content"]);

$file_name = $_ENV['STATIC'].$_POST["file_name"];
$file_content_as_dataUrl = $_POST["content"];
list($type, $data) = explode(';', $file_content_as_dataUrl);
list(, $data) = explode(',', $data);
$file_content = base64_decode($data);
file_put_contents($file_name, $file_content);

echo "success";