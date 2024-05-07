<?php
namespace db\orm;

function compare(string $col, string $operator, string $value) {
  $query = "$col $operator ?";
  return [$query, [$value]];
}

function eq(string $col, string $value) {
  $query = "$col = ?";
  return [$query, [$value]];
}

function col_eq(string $col, string $col2) {
  $query = "$col = $col2";
  return [$query, []];
}

function not(array $args) {
  $query = $args[0];
  $query = "NOT ($query)";
  return [$query, $args[1]];
}

function join_and(array ...$args) {
  $query = [];
  foreach($args as $arg) {
    if(!is_array($arg)) continue;
    if(count($arg) === 0 || count($arg) > 2) continue;
    $query[] = $arg[0];
  }
  $query = implode(" AND ", $query);
  $arguments = [];
  foreach($args as $arg) {
    if(!is_array($arg)) continue;
    if(count($arg) !== 2) continue;
    if(!is_array($arg[1])) continue;
    $arguments = array_merge($arguments, $arg[1]);
  }
  return ["($query)", $arguments];
}

function join_or(array ...$args) {
  $query = [];
  foreach($args as $arg) {
    if(!is_array($arg)) continue;
    if(count($arg) === 0 || count($arg) > 2) continue;
    $query[] = $arg[0];
  }
  $query = implode(" OR ", $query);
  $arguments = [];
  foreach($args as $arg) {
    if(!is_array($arg)) continue;
    if(count($arg) !== 2) continue;
    if(!is_array($arg[1])) continue;
    $arguments = array_merge($arguments, $arg[1]);
  }
  return ["($query)", $arguments];
}