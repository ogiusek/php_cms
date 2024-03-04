<?php
namespace db\pages\content;

function create(int $page_id, string $content) {
  $biggest_order = \db\select("SELECT MAX(`order`) AS `order` FROM `pages_content` WHERE `page_id` = ?", [$page_id])[0]["order"] ?? -1;
  return \db\modify("INSERT INTO `pages_content` (`page_id`, `content`, `order`) VALUES (?, ?, ?)", [$page_id, $content, $biggest_order + 1]);
}

function get_all() {
  return \db\select("SELECT `id`, `page_id`, `content`, `order` FROM `pages_content` ORDER BY `page_id` ASC, `order` ASC");
}

function get_by_id(int $id) {
  return \db\select("SELECT `id`, `page_id`, `content`, `order` FROM `pages_content` WHERE `id` = ?", [$id]);
}

function get(int $page_id) {
  return \db\select("SELECT `id`, `content`, `order` FROM `pages_content` WHERE `page_id` = ? ORDER BY `order` ASC", [$page_id]);
}

function add(int $page_id, string $content) {
  $biggest_order = \db\select("SELECT MAX(`order`) AS `order` FROM `pages_content` WHERE `page_id` = ?", [$page_id])[0]["order"] ?? -1;
  return \db\modify("INSERT INTO `pages_content` (`page_id`, `content`, `order`) VALUES (?, ?, ?)", [$page_id, $content, $biggest_order + 1]);
}

function edit(int $id, string $content) {
  return \db\modify("UPDATE `pages_content` SET `content` = ? WHERE `id` = ?", [$content, $id]);
}

function delete(int $id) {
  return \db\modify("DELETE FROM `pages_content` WHERE `id` = ?", [$id]);
}

function change_order(int $id, int $order) {
  $current_element = \db\select("SELECT `page_id`, `order` FROM `pages_content` WHERE `id` = ?", [$id])[0];
  $page_id = $current_element["page_id"];
  $current_order = $current_element["order"];

  $smaller_order = min($current_order, $order);
  $bigger_order = max($current_order, $order);
  return \db\modify(
   "UPDATE `pages_content`
    SET `order` = 
      CASE
        WHEN `id` = ? THEN ?
        WHEN `order` < ? AND `order` > ? THEN `order`
        WHEN ? < ? THEN `order` + 1
        ELSE `order` - 1
      END
    WHERE `page_id` = ?", [
      $id, $order,
      $smaller_order, $bigger_order,
      $order, $current_order,
      $page_id]);
}
