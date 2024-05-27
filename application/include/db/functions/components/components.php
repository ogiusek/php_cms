<?php
namespace db\components;

function autoload() {
  // delete();
  $elements = \components()->list_components();
  foreach($elements as $element) {
    add($element);
  }
}

function add(string $class_name) {
  return \db\query("INSERT INTO `components` (`class_name`) VALUES (?)", [$class_name]);
}

function delete(int $id = -1) {
  if ($id == -1) return \db\query("DELETE FROM `components`");
  return \db\query("DELETE FROM `components` WHERE `id` = ?", [$id]);
}

function edit(int $id, string $class_name) {
  return \db\query("UPDATE `components` SET `class_name` = ? WHERE `id` = ?", [$class_name, $id]);
}

function get() {
  return \db\select("SELECT `id`, `class_name` FROM `components`");
}

function get_by_id(int $id) {
  return \db\select("SELECT `id`, `class_name` FROM `components` WHERE `id` = ?", [$id]);
}
