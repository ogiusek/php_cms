<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods(["DELETE"])
  ->require_params(["id"]);

if(!\db\pages\delete($_POST['id'])){
  \request\response()
    ->setStatus(400)
    ->setContent("page do not exists")
    ->send();
}

\request\response()
  ->setContent("success")
  ->send();
