<?php
namespace db;
function select(string $query, array $params = []) {
  $stmt = $GLOBALS["db"]->prepare($query);
  $stmt->execute($params);
  $result = $stmt->get_result();
  return $result->fetch_all(MYSQLI_ASSOC);
}

function insert(string $query, array $params = []) {
  $stmt = $GLOBALS["db"]->prepare($query);
  $stmt->execute($params);
}