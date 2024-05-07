<?php
namespace db\orm;

class Insert{
  private string $table = "";
  private array $columns = [];
  public function __construct(string ...$args) {
    $this->columns = $args;
    if(count($args) == 0) return;
    $this->table = explode(".", $args[0])[0];
  }

  private array $values;
  public function values(string ...$args) {
    if(count($args) != count($this->columns))
      throw new \Exception("Number of values must be equal to number of columns");
    $this->values = $args;
    return $this;
  }

  public function run() {
    $table = $this->table;
    $columns = implode(",", $this->columns);

    $question_mark_array = array_fill(0, count($this->values), "?");
    $question_marks = implode(", ", $question_mark_array);
    $query = "INSERT INTO $table($columns) VALUES ($question_marks);";
    $is_error = !\db\query($query, $this->values);
    return $is_error;
  }
};

