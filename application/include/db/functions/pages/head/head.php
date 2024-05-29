<?php
namespace db\pages\head;

class IHead {
  public int $color_palette_id = -1;
  public \head\IHead $head;

  function get_colors(){
    $colors = \db\colors\get_by_id($this->color_palette_id);
    if(count($colors) === 0) $colors = \db\colors\get();
    if(count($colors) === 0) {
      \db\colors\add("admin");
      $colors = \db\colors\get();
    }
    return $colors[0];
  }

  function __construct(\head\IHead $head = null, int $color_palette_id = null) {
    $this->head = $head?? new \head\IHead();
    $this->color_palette_id = $color_palette_id == null ? -1 : $color_palette_id;
  }
}

function add(int $page_id) {
  $content = serialize(new IHead());
  return \db\query("INSERT INTO `pages_head` (`page_id`, `content`) VALUES (?, ?)", [$page_id, $content]);
}

function delete(int $page_id) {
  return \db\query("DELETE FROM `pages_head` WHERE `page_id` = ?", [$page_id]);
}

function update(int $page_id, IHead $content) {
  $content = serialize($content);
  add($page_id);
  return \db\query("UPDATE `pages_head` SET `content` = ? WHERE `page_id` = ?", [$content, $page_id]);
}

function get(){
  $heads = \db\select("SELECT `page_id`, `content` FROM `pages_head`");
  foreach($heads as &$head) $head['content'] = unserialize($head['content']);
  return $heads;
}

function get_by_page_id(int $page_id): IHead {
  $content = \db\select("SELECT `content` FROM `pages_head` WHERE `page_id` = ?", [$page_id]);
  $element = $content[0]['content'] ?? null;
  $default_head = new IHead();
  return $element ? unserialize($element) : $default_head;
}
