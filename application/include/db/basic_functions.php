<?php
namespace db;
function select(string $query, array $params = []) {
  $stmt = $GLOBALS["db"]->prepare($query);
  $stmt->execute($params);
  $result = $stmt->get_result();
  return $result->fetch_all(MYSQLI_ASSOC);
}

function modify(string $query, array $params = []) {
  $success = true;
  try{
    $stmt = $GLOBALS["db"]->prepare($query);
    $stmt->execute($params);
  } catch(\Exception $e) {
    // echo $e->getMessage();
    $success = false;
  }
  return $success;
}