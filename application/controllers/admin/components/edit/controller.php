<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods(["PATCH"])
  ->require_params(["id", "class_name"]);

if(!\db\components\edit($_POST["id"], $_POST["class_name"])) {
  \request\response()
    ->setStatus(400)
    ->setContent("error while updating page")
    ->send();
}

\request\response()
  ->setContent("success")
  ->send();
