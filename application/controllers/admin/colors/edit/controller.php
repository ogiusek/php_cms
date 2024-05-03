<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods("POST")
  ->require_params(["id", "name", "colors"]);

if(!\db\colors\edit($_POST['id'], $_POST['name'], $_POST['colors'])){
  \request\response()
    ->setStatus(400)
    ->setContent("cannot use this name")
    ->send();
}

\request\response()
  ->setContent("Successfully edited color")
  ->send();