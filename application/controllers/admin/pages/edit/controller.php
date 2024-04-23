<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods(["PATCH"])
  ->require_params(["id", "page", "file", "order"]);

if(!\db\pages\update($_POST['id'], $_POST['page'], $_POST['file'], $_POST['order'])){
  \request\response()
    ->setStatus(400)
    ->setContent("error while updating page")
    ->send();
}

\request\response()
  ->setContent("success")
  ->send();
