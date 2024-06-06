<?php
namespace components;
class admin_pages_content_form {
  public int $page_id = -1;

  public function __construct($page_id = null) {
    if($page_id !== null && is_numeric($page_id))
      $this->page_id = $page_id;
  }
};
