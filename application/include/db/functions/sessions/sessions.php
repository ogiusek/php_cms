<?php
namespace db\sessions;

function remove(int $user_id) {
  // remove outdated sessions
  // \db\query("DELETE FROM `users_sessions` WHERE `user_id` = ? AND `session_start` < NOW() - INTERVAL 48 HOUR", [$user_id]);
  return \db\query("DELETE FROM `users_sessions` WHERE `user_id` = ?", [$user_id]);
}

function select(int $user_id) {
  return \db\select("SELECT `uuid` 
                     FROM `users_sessions` 
                     WHERE `user_id` = ? 
                     AND `session_start` > NOW() - INTERVAL 48 HOUR
                     ORDER BY `session_start` DESC 
                     LIMIT 1", [$user_id])[0]['uuid'] ?? null;
}

function create(int $user_id) {
  \db\query("INSERT INTO `users_sessions` (`user_id`) VALUES (?)", [$user_id]);
  $uuid = select($user_id);
  return $uuid;
}

function get(int $user_id) {
  $uuid = select($user_id) ?? create($user_id);
  return $uuid;
}

function get_user_id(string $uuid) {
  return \db\select("SELECT `user_id` FROM `users_sessions` WHERE `uuid` = ?", [$uuid])[0]['user_id'] ?? null;
}