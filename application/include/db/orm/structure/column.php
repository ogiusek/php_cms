<?php
namespace db\orm\table;

class IColumn {
  public string $table;
  public function table(string $table): self {
    $this->table = $table;
    return $this;
  }
  public string $name;
  public function name(string $name): self {
    $this->name = $name;
    return $this;
  }
  public string $column_type = "";
  public function type(string $column_type): self {
    $this->column_type = $column_type;
    return $this;
  }
  public bool $is_nullable = true;
  public function can_be_null(bool $is_nullable = true): self {
    $this->is_nullable = $is_nullable;
    return $this;
  }
  public string $column_key = "";
  public function primary(): self {
    $this->is_nullable = false;
    $this->column_key = "PRI";
    return $this;
  }
  public function unique(): self {
    $this->is_nullable = false;
    $this->column_key = "UNI";
    return $this;
  }
  public $column_default = null;
  public function default($column_default = null): self {
    $this->column_default = $column_default;
    return $this;
  }
  public bool $auto_increment = false;
  public function auto_increment(): self {
    $this->auto_increment = true;
    return $this;
  }

  public function create_query(): string {
    // name and data type
    $query = "`".$this->name."` ".$this->column_type." ";
    // column key
    if($this->column_key === "PRI")
      $query .= " PRIMARY KEY";
    else if($this->column_key === "UNI")
      $query .= " UNIQUE";
  // is nullable
    $query .= $this->is_nullable ? " NULL" : " NOT NULL";
    // auto increment
    if($this->auto_increment)
      $query .= " AUTO_INCREMENT";
    // default
    if($this->column_default !== null)
      $query .= " DEFAULT ".$this->column_default;
    return $query;
  }

  public function __toString() {
    return $this->table.".".$this->name;
  }
};