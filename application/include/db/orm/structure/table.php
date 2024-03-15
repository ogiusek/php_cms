<?php
namespace db\orm\table;
require_once "column.php";

class ITable {
  private string $db_name;
  private string $table_name;
  private array $columns = [];
  private static ?array $table_data = null;

  private function table_exists(): bool {
    return in_array($this->table_name, array_column(self::$table_data, "TABLE_NAME"));
  }

  private function create_table(): self {
    $table_name = $this->table_name;
    $query = "CREATE TABLE `$table_name` (";
    $columns = array_map(function($column) {
      return $column->create_query();
    }, $this->columns);
    $query .= implode(", ", $columns);
    $query .= ");";
    \db\modify($query);
    return $this;
  }

  private function tables_to_query(array $tables): array {
    return array_map(function($row) {
      $column = new IColumn();
      $column->name($row["COLUMN_NAME"])
        ->type($row["COLUMN_TYPE"])
        ->can_be_null($row["IS_NULLABLE"] === "YES" ? true : false);
      if ($row["COLUMN_DEFAULT"] !== null)
        $column->default($row["COLUMN_DEFAULT"]);
      if($row["COLUMN_KEY"] === "PRI")
        $column->primary();
      if($row["COLUMN_KEY"] === "UNI")
        $column->unique();
      if($row["EXTRA"] === "auto_increment")
        $column->auto_increment();
      return $column->create_query();
    }, $tables);
  }

  private function is_table_correct(): bool {
    $actual_table = array_filter(self::$table_data, function($table) {return $table["TABLE_NAME"] === $this->table_name;});
    $actual_table_as_query = $this->tables_to_query($actual_table);
    
    foreach ($this->columns as $column) {
      if(!($column instanceof IColumn))
        continue;
      if($column->column_type === "")
      continue;
      if(!in_array($column->create_query(), $actual_table_as_query))
      return false;
    }
    echo "2";
    return true;
  }

  private static function normalize(string $value): string {
    $value = strtolower($value);
    $value = str_replace("(uuid())", "uuid()", $value);
    return $value;
  }

  private function load_columns(): self {
    $actual_table = array_filter(self::$table_data, function($row) { return $row["TABLE_NAME"] === $this->table_name; });
    $actual_table_as_query = $this->tables_to_query($actual_table);

    // add not present columns in table definition
    foreach ($this->columns as $column) {
      if(!($column instanceof IColumn)) continue;
      if($column->column_type === "") continue;
      $column_index = array_search($column->name, array_map(function($row) { return $row["COLUMN_NAME"]; }, $actual_table));
      if($this->normalize($column->create_query()) === $this->normalize($actual_table_as_query[$column_index])) continue;
      $already_exists = $column_index !== false;
      $query = "ALTER TABLE `".$this->table_name."` ";
      $query .= $already_exists ? "MODIFY" : "ADD";
      $query .= " COLUMN ";
      $query .= $column->create_query();
      if($already_exists && $column->column_key === "" && $actual_table[$column_index]["COLUMN_KEY"] !== "")
        $query .= ", DROP KEY `".$column->name."`";
      \db\modify($query);
    }
    // remove not present columns in table definition
    foreach ($actual_table as $column) {
      if(!in_array($column["COLUMN_NAME"], array_map(function($column) { return $column->name; }, $this->columns))){
        $query = "ALTER TABLE `".$this->table_name."` DROP COLUMN `".$column["COLUMN_NAME"]."`;";
        \db\modify($query);
      }
    }
    return $this;
  }

  public function load(): self {
    if(!$this->table_exists())
    return $this->create_table();
    if($this->is_table_correct()) return $this;
    return $this->load_columns();
  }

  public function __construct(string $table_name) {
    $this->db_name = $_ENV["DB_DATABASE"];
    $this->table_name = $table_name;
    self::$table_data ??= \db\select("SELECT `COLUMN_NAME`, `COLUMN_TYPE`, `IS_NULLABLE`, `COLUMN_DEFAULT`, `COLUMN_KEY`, `EXTRA`, `TABLE_NAME` FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ?;", [$this->db_name]);
  }

  public function __set($name, $value) {
    if(!($value instanceof IColumn))
      return;
    $this->columns[$name] = $value->table($this->table_name)->name($name);
  }

  public function __get($name) {
    $as_string = strval($this->columns[$name]);
    return $as_string;
  }

  public function __toString() {
    return $this->table_name;
  }
};