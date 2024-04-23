<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods(["DELETE"])
  ->require_params(["id"]);

if(!\db\pages\content\delete($_POST["id"])){
  \request\response()
    ->setStatus(404)
    ->setContent("Content not found")
    ->send();
}

\request\response()
  ->setContent("Content deleted")
  ->send();