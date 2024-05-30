<?php
namespace db\pages;
require_once "content/content.php";
require_once "head/head.php";

function add(string $page, string $file, int $order = 0) {
  return \db\query("INSERT INTO `pages` (`page`, `file`, `order`) VALUES (?, ?, ?)", [$page, $file, $order]);
}

function delete(int $id) {
  \db\query("DELETE FROM `pages_content` WHERE `page_id` = ?", [$id]);
  return \db\query("DELETE FROM `pages` WHERE `id` = ?", [$id]);
}

function update(string $id, string $page, string $file, int $order = 0) {
  return \db\query("UPDATE `pages` SET `page` = ?, `file` = ?, `order` = ? WHERE `id` = ?", [$page, $file, $order, $id]);
}

function get(bool $remove_admin_pages = false) {
  $pages = \db\select("SELECT `id`, `page`, `file`, `order` FROM `pages` ORDER BY `order` DESC");
  if($remove_admin_pages) {
    $pages = array_filter($pages, function($page) {
      return !in_array($page['page'], ["/admin", "/admin/.*"]);
    });
  }
  return $pages;
}

function get_by_id(int $id) {
  return \db\select("SELECT `id`, `page`, `file`, `order` FROM `pages` WHERE `id` = ?", [$id]);
}