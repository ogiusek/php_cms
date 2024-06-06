<?php
namespace components;
class admin_header_form{
  public int $page_id;
  function __construct(int $page_id) {
    $this->page_id = $page_id;
  }
};