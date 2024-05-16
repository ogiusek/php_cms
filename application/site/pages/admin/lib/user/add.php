<?php
function confirm_user($email, $password){
  
}

function add_user($email){
  $db = &$GLOBALS["db"];

  $emails = db\select("SELECT email FROM users WHERE email = ?
                       UNION
                       SELECT email FROM waiting_users WHERE email = ?", [
    $email,
    $email
  ]);

  if(count($emails) > 0){
    return "user already exists";
  }

  db\query("INSERT INTO waiting_users (email) VALUES (?)", [$email]);
  $user_uuid = db\select("SELECT uuid FROM waiting_users WHERE email = ?", [$email])[0]['uuid'];

  send_mail($email, "php cms - email verification", $_SERVER['SERVER_NAME'] . "/admin/?page=confirm_user&uuid=$user_uuid");

  return "success";
}
