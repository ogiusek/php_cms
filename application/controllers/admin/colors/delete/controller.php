<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods("DELETE")
  ->require_params(["id"]);

if(!\db\colors\delete($_POST['id'])){
  \request\response()
    ->setStatus(400)
    ->setContent("cannot delete color palette")
    ->send();
}

\request\response()
  ->setContent("Successfully deleted color")
  ->send();