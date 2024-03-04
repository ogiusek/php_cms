<?php
namespace db\components;

function add(string $class_name) {
  return \db\modify("INSERT INTO `components` (`class_name`) VALUES (?)", [$class_name]);
}

function delete(int $id) {
  return \db\modify("DELETE FROM `components` WHERE `id` = ?", [$id]);
}

function edit(int $id, string $class_name) {
  return \db\modify("UPDATE `components` SET `class_name` = ? WHERE `id` = ?", [$class_name, $id]);
}

function get() {
  return \db\select("SELECT `id`, `class_name` FROM `components`");
}

function get_by_id(int $id) {
  return \db\select("SELECT `id`, `class_name` FROM `components` WHERE `id` = ?", [$id]);
}
