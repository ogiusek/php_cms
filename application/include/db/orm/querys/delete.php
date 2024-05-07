<?php
namespace db\orm;

class Delete{
  private $table = "";
  public function __construct(string $table) {
    $this->table = $table;
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

    $where = implode(" AND ", $this->where);
    $where = empty($where) ? "" : " WHERE $where";

    $limit = $this->limit > 0 ? " LIMIT $this->limit" : "";
    $offset = $this->offset > 0 ? " OFFSET $this->offset" : "";

    $query = "DELETE FROM $table $where $limit $offset;";
    $arguments = $this->where_arguments;
    $is_error = !\db\query($query, $arguments);
    return $is_error;
  }
};

