<?php
namespace components;
class files{
  public string $dir;
  public function __construct(string $dir = "") {
    $this->dir = $dir;
  }
};