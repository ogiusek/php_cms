<?php
namespace db\pages;

function create(string $page, string $file, int $order = 0) {
  return \db\insert("INSERT INTO `pages` (`page`, `file`, `order`) VALUES (?, ?, ?)", [$page, $file, $order]);
}

function delete(int $id) {
  return \db\insert("DELETE FROM `pages` WHERE `id` = ?", [$id]);
}

function update(string $id, string $page, string $file, int $order = 0) {
  return \db\insert("UPDATE `pages` SET `page` = ?, `file` = ?, `order` = ? WHERE `id` = ?", [$page, $file, $order, $id]);
}

function select_pages() {
  return \db\select("SELECT `id`, `page`, `file`, `order` FROM `pages` ORDER BY `order` DESC");
}