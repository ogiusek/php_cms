<?php
\request\verify()
  ->allowed_methods(["POST"])
  ->require_params(["email", "password"]);

$user_id = \db\user\login($_POST['email'], $_POST['password']);
if($user_id == null) {
  \request\response()
    ->setStatus(400)
    ->setContent("Invalid email or password")
    ->send();
}

$session_token = \db\sessions\get($user_id);
$_SESSION['session_token'] = $session_token;
\request\response()
  ->setContent(["session" => $session_token])
  ->send();