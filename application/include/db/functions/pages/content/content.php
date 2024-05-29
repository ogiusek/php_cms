<?php
namespace db\pages\content;

function add(int $page_id, string $content) {
  $biggest_order = \db\select("SELECT MAX(`order`) AS `order` FROM `pages_content` WHERE `page_id` = ?", [$page_id])[0]["order"] ?? -1;
  return \db\query("INSERT INTO `pages_content` (`page_id`, `content`, `order`) VALUES (?, ?, ?)", [$page_id, $content, $biggest_order + 1]);
}

function delete(int $id) {
  return \db\query("DELETE FROM `pages_content` WHERE `id` = ?", [$id]);
}

function edit(int $id, string $content) {
  return \db\query("UPDATE `pages_content` SET `content` = ? WHERE `id` = ?", [$content, $id]);
}

function get() {
  return \db\select("SELECT `id`, `page_id`, `content`, `order` FROM `pages_content` ORDER BY `page_id` ASC, `order` ASC");
}


function get_by_id(int $id) {
  return \db\select("SELECT `id`, `page_id`, `content`, `order` FROM `pages_content` WHERE `id` = ?", [$id]);
}

function get_by_page_id(int $page_id) {
  return \db\select("SELECT `id`, `content`, `order` FROM `pages_content` WHERE `page_id` = ? ORDER BY `order` ASC", [$page_id]);
}

function move_after(int $id, int $after_id) {
  repair_page_order(-1, $id);
  // $order_1 = \db\select("SELECT `order` FROM `pages_content` WHERE `id` = ?", [$id])[0]["order"];
  $order_2 = \db\select("SELECT `order` FROM `pages_content` WHERE `id` = ?", [$after_id])[0]["order"]?? -1;
  \db\query("UPDATE `pages_content` AS pc1
    JOIN (SELECT `page_id` FROM `pages_content` WHERE `id` = ?) AS pc2
    SET `order` = CASE
        WHEN pc1.`id` = ? THEN ? + 1
        WHEN pc1.`order` > ? THEN pc1.`order` + 1
        ELSE pc1.`order`
    END
    WHERE pc1.`page_id` = pc2.`page_id`;
    ", [$id, $id, $order_2, $order_2]);
  repair_page_order(-1, $id);
}

function repair_page_order(int $page_id = -1, int $element_id = -1) {
  return \db\query("UPDATE `pages_content` AS `pc`
  INNER JOIN (
    SELECT
      `id`,
      ROW_NUMBER() OVER(ORDER BY `order`) - 1 AS `new_order`
    FROM `pages_content`
    WHERE `page_id` = ? OR `page_id` = (SELECT `page_id` FROM `pages_content` WHERE `id` = ?)
  ) AS `t` 
  ON `pc`.`id` = `t`.`id`
  SET `pc`.`order` = `t`.`new_order`;", [$page_id, $element_id]);
}
