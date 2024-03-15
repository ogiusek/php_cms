<?php
namespace db\orm;
require_once "table.php";

function table(string $name) {
  return new \db\orm\table\ITable($name);
}

function column() {
  return new \db\orm\table\IColumn();
}