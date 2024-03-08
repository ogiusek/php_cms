<?php
// create tables
$tables = [
  "CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `hash` VARCHAR(256)
  )",
  "CREATE TABLE IF NOT EXISTS `waiting_users` (
    `uuid` VARCHAR(36) PRIMARY KEY DEFAULT (UUID()),
    `email` VARCHAR(255) UNIQUE NOT NULL
  )",
  "CREATE TABLE IF NOT EXISTS `users_sessions` (
    `uuid` VARCHAR(36) PRIMARY KEY DEFAULT (UUID()),
    `user_id` INT NOT NULL,
    `session_start` DATETIME DEFAULT CURRENT_TIMESTAMP
  )",

  "CREATE TABLE IF NOT EXISTS `pages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `page` VARCHAR(255) UNIQUE NOT NULL,
    `file` VARCHAR(255) NOT NULL,
    `order` SMALLINT DEFAULT 0
  )",
  "CREATE TABLE IF NOT EXISTS `pages_content` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `page_id` INT NOT NULL,
    `content` TEXT NOT NULL,
    `order` INT UNSIGNED DEFAULT 0
  )",

  "CREATE TABLE IF NOT EXISTS `components` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `class_name` VARCHAR(255) UNIQUE NOT NULL
  )"
];

$default_rows = [
  "INSERT INTO `pages` (`page`, `file`, `order`) VALUES ('/', 'menager.php', 0)",
  "INSERT INTO `pages` (`page`, `file`, `order`) VALUES ('/admin', 'admin/admin.php', -1)",
  // "INSERT INTO `pages` (`page`, `file`, `order`) VALUES ('/admin/$', 'admin/admin.php', 0)",
  "INSERT INTO `pages` (`page`, `file`, `order`) VALUES ('/admin/.*', 'admin/admin.php', -2)",
];

try{
  foreach ($tables as $table_query) {
    $db = &$GLOBALS["db"];
    $db->query($table_query);
  }

  foreach ($default_rows as $row_query) {
    $db = &$GLOBALS["db"];
    $db->query($row_query);
  }
} catch (Exception $e) {
  // echo "Disable LOAD_DEFAULT_DATABASE_CONFIG in .env";
}