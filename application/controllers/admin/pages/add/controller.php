<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods(["POST"])
  ->require_params(["page", "file", "order"]);
  
if(!\db\pages\add($_POST['page'], $_POST['file'], $_POST['order'])){
  \request\response()
    ->setStatus(400)
    ->setContent("page already exists")
    ->send();
}

\request\response()
  ->setContent("success")
  ->send();
