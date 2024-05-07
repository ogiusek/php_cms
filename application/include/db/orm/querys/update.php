<?php
namespace db\orm;

class Update{
  private $table = "";
  private $columns = [];
  public function __construct(string ...$args) {
    $this->columns = $args;
    if(count($args) == 0) return;
    $this->table = explode(".", $args[0])[0];
  }

  private array $values;
  public function set(string ...$args) {
    if(count($args) != count($this->columns))
      throw new \Exception("Number of values must be equal to number of columns");
    $this->values = $args;
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
    $table = $this->table;
    $columns = implode(" = ?, ", $this->columns)." = ?";

    $where = implode(" AND ", $this->where);
    $where = empty($where) ? "" : " WHERE $where";

    $limit = $this->limit > 0 ? " LIMIT $this->limit" : "";
    $offset = $this->offset > 0 ? " OFFSET $this->offset" : "";

    $query = "UPDATE $table SET $columns $where $limit $offset;";
    $arguments = array_merge($this->values, $this->where_arguments);
    $is_error = !\db\query($query, $arguments);
    return $is_error;
  }
};

