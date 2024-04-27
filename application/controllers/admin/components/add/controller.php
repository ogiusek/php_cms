<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods(["POST"])
  ->require_params(["class_name"]);
  
if(!\db\components\add($_POST['class_name'])){
  \request\response()
    ->setStatus(400)
    ->setContent("Component already exists")
    ->send();
}

\request\response()
  ->setContent("success")
  ->send();
