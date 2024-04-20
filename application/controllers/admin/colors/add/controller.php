<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods("POST")
  ->require_params(["name"]);

if(!\db\colors\add($_POST['name'])){
  \request\response()
    ->setStatus(400)
    ->setContent("color already exists")
    ->send();
}

\request\response()
  ->setContent("Successfully added color")
  ->send();