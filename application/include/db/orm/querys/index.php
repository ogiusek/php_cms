<?php
namespace db\orm;
require_once "functions.php";

require_once "select.php";
require_once "insert.php";
require_once "update.php";
require_once "delete.php";

function select(string ...$args) { return new \db\orm\Select(...$args); }
function insert(string ...$args) { return new \db\orm\Insert(...$args); }
function update(string ...$args) { return new \db\orm\Update(...$args); }
function delete(string $table) { return new \db\orm\Delete($table); }