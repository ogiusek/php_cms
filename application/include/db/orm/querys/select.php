<?php
namespace db\orm;

class Select{
  private string $select = "*";
  public function __construct(string ...$args) {
    if(count($args) > 0) $this->select = implode(", ", $args);
  }

  private string $from = "";
  public function from(string $from): self {
    $this->from = $from;
    return $this;
  }

  private string $join = "";
  private array $join_arguments = [];
  public function join(string $table, array $on, string $type = "INNER") {
    $on_arg = $on[0];
    $this->join = " $type JOIN $table ON $on_arg";
    $this->join_arguments = $on[1];
    return $this;
  }

  private array $where = [];
  private array $where_arguments = [];
  public function where(array ...$args) {
    $this->where = [];
    $this->where_arguments = [];
    foreach($args as $value) {
      if(count($value) === 0 || count($value) > 2) continue;
      if(!is_string($value[0])) continue;
      $this->where[] = $value[0];
      if(count($value) === 1) continue;
      if(!is_array($value[1])) continue;
      $this->where_arguments = array_merge($this->where_arguments, $value[1]);
    }
    return $this;
  }

  private array $order_by = [];
  public function order_by(array ...$args) {
    foreach($args as $arg) {
      if(count($args) !== 2) continue;
      if(!is_string($arg[0])) continue;
      if(!is_string($arg[1])) continue;
      $this->order_by[] = "$arg[0] $arg[1]";
    }
    return $this;
  }
  private array $group_by = [];
  public function group_by(array ...$args) {
    foreach($args as $arg) {
      if(count($args) !== 2) continue;
      if(!is_string($arg[0])) continue;
      if(!is_string($arg[1])) continue;
      $this->group_by[] = "$arg[0] $arg[1]";
    }
    return $this;
  }

  private int $limit = 0;
  public function limit(int $limit): self {
    $this->limit = $limit;
    return $this;
  }
  private int $offset = 0;
  public function offset(int $offset): self {
    $this->offset = $offset;
    return $this;
  }

  public function run() {
    $selected_columns = $this->select;
    $table = $this->from;
    $join = $this->join;
    
    $where = implode(" AND ", $this->where);
    $where = empty($where) ? "" : " WHERE $where";
    
    $group_by = empty($this->group_by) ? "" : " GROUP BY " . implode(", ", $this->group_by);
    $order_by = empty($this->order_by) ? "" : implode(", ", $this->order_by);
    
    $limit = $this->limit > 0 ? " LIMIT $this->limit" : "";
    $offset = $this->offset > 0 ? " OFFSET $this->offset" : "";

    $query = "SELECT $selected_columns FROM $table $join $where $group_by $order_by $limit $offset;";
    $arguments = array_merge($this->join_arguments, $this->where_arguments);
    $result = \db\select($query, $arguments);
    return $result;
  }
};
