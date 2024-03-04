<?php
namespace db\user;

function get_email(int $user_id) {
  return \db\select("SELECT email FROM `users` WHERE `id` = ?", [$user_id])[0] ?? null;
}

function login(string $email, string $password) {
  $email = strtolower($email);
  $hash = hash("sha256", $password);
  return \db\select("SELECT id FROM `users` WHERE `email` = ? AND `hash` = ?", [$email, $hash])[0]['id'] ?? null;
}

function create_account(string $email, string $password) {
  $email = strtolower($email);
  $hash = hash("sha256", $password);
  return \db\modify("INSERT INTO `users` (`email`, `hash`) VALUES (?, ?)", [$email, $hash]);
}
