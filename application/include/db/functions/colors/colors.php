<?php
namespace db\colors;

class IColor {
  public int $id;
  public string $name;
  public array $colors;

  function __construct(int $id, string $name, \colors\IColors $colors) {
    $this->id = $id;
    $this->name = $name;
    $this->colors = $colors->colors;
  }
};

function add(string $name) {
  $default_colors = new \colors\IColors();
  return \db\query("INSERT INTO `color_paletts` (`name`, `colors`) VALUES (?, ?)", [$name, serialize($default_colors)]);
}

function delete(int $id) {
  return \db\query("DELETE FROM `color_paletts` WHERE `id` = ?", [$id]);
}

function edit(int $id, string $name, array $colors) {
  $colors = new \colors\IColors($colors);
  return \db\query("UPDATE `color_paletts` SET `name` = ?, `colors` = ? WHERE `id` = ?", [$name, serialize($colors), $id]);
}

function get() {
  $result = \db\select("SELECT `id`, `name`, `colors` FROM `color_paletts`");
  $result = array_map(function($row) {
    $row = new \db\colors\IColor($row['id'], $row['name'], unserialize($row['colors']));
    return $row;
  }, $result);
  return $result;
}

function get_by_id(int $id) {
  $result = \db\select("SELECT `id`, `name`, `colors` FROM `color_paletts` WHERE `id` = ?", [$id]);
  $result = array_map(function($row) {
    $row = new \db\colors\IColor($row['id'], $row['name'], unserialize($row['colors']));
    return $row;
  }, $result);
  return $result;
}

function get_by_page_id(int $page_id) {
  $head = \db\pages\head\get_by_page_id($page_id);
  $result = $head->get_colors();
  return $result;
}