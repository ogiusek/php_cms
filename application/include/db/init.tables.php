<?php
namespace db;

class tables{
  private array $tables = [];
  public function __set($name, $value){$this->tables[$name] = $value;}
  public function &__get($name){return $this->tables[$name];}
  public function &get_tables_list(){return $this->tables;}
  public function __construct(){
    $this->tables = [
      $this->users(),
      $this->waiting_users(),
      $this->users_sessions(),
      $this->pages(),
      $this->pages_head(),
      $this->pages_content(),
      $this->components(),
      $this->color_paletts()
    ];
  }

  public function &users(){
    static $users = null;
    if($users !== null) return $users;
    $users = orm\table("users");
    $users->id = orm\column()->type("INT")->primary()->auto_increment()->can_be_null(false);
    $users->email = orm\column()->type("VARCHAR(255)")->unique()->can_be_null(false);
    $users->hash = orm\column()->type("VARCHAR(256)")->can_be_null(true);
    return $users;
  }
  public function &waiting_users(){
    static $waiting_users = null;
    if($waiting_users !== null) return $waiting_users;
    $waiting_users = orm\table("waiting_users");
    $waiting_users->uuid = orm\column()->type("VARCHAR(36)")->primary()->can_be_null(false)->default("(UUID())");
    $waiting_users->email = orm\column()->type("VARCHAR(255)")->unique()->can_be_null(false);
    return $waiting_users;
  }
  public function &users_sessions(){
    static $users_sessions = null;
    if($users_sessions !== null) return $users_sessions;
    $users_sessions = orm\table("users_sessions");
    $users_sessions->uuid = orm\column()->type("VARCHAR(36)")->primary()->can_be_null(false)->default("(UUID())");
    $users_sessions->user_id = orm\column()->type("INT")->can_be_null(false);
    $users_sessions->session_start = orm\column()->type("DATETIME")->default("CURRENT_TIMESTAMP");
    return $users_sessions;
  }
  public function &pages(){
    static $pages = null;
    if($pages !== null) return $pages;
    $pages = orm\table("pages");
    $pages->id = orm\column()->type("INT")->primary()->auto_increment();
    $pages->page = orm\column()->type("VARCHAR(255)")->unique()->can_be_null(false);
    $pages->file = orm\column()->type("VARCHAR(255)")->can_be_null(false);
    $pages->order = orm\column()->type("SMALLINT")->default(0);
    return $pages;
  }
  public function &pages_head(){
    static $pages_head = null;
    if($pages_head !== null) return $pages_head;
    $pages_head = orm\table("pages_head");
    $pages_head->id = orm\column()->type("INT")->primary()->auto_increment();
    $pages_head->page_id = orm\column()->type("INT")->unique()->can_be_null(false);
    $pages_head->content = orm\column()->type("TEXT")->can_be_null(false);
    return $pages_head;
  }
  public function &pages_content(){
    static $pages_content = null;
    if($pages_content !== null) return $pages_content;
    $pages_content = orm\table("pages_content");
    $pages_content->id = orm\column()->type("INT")->primary()->auto_increment();
    $pages_content->page_id = orm\column()->type("INT")->can_be_null(false);
    $pages_content->content = orm\column()->type("TEXT")->can_be_null(false);
    $pages_content->order = orm\column()->type("INT UNSIGNED")->default(0);
    return $pages_content;
  }
  public function &components(){
    static $components = null;
    if($components !== null) return $components;
    $components = orm\table("components");
    $components->id = orm\column()->type("INT")->primary()->auto_increment();
    $components->class_name = orm\column()->type("VARCHAR(255)")->unique()->can_be_null(false);
    return $components;
  }
  public function &color_paletts(){
    static $color_paletts = null;
    if($color_paletts !== null) return $color_paletts;
    $color_paletts = orm\table("color_paletts");
    $color_paletts->id = orm\column()->type("INT")->primary()->auto_increment();
    $color_paletts->name = orm\column()->type("VARCHAR(255)")->unique()->can_be_null(false);
    $color_paletts->colors = orm\column()->type("TEXT")->can_be_null(false);
    return $color_paletts;
  }
};

function &get_tables() {
  static $tables;
  $tables ??= new tables();
  return $tables;
}

function load_default_rows() {
  $tables = &get_tables();
  // orm\insert($tables->pages()->page, $tables->pages()->file, $tables->pages()->order)->values("/", "menager.php", 0)->run();
  orm\insert($tables->pages()->page, $tables->pages()->file, $tables->pages()->order)->values("/admin", "admin/admin.php", -1)->run();
  orm\insert($tables->pages()->page, $tables->pages()->file, $tables->pages()->order)->values("/admin/.*", "admin/admin.php", -2)->run();
}

function init_tables() {
  $tables = get_tables()->get_tables_list(); // this lines initializes the tables for the first time
  if(!$_ENV["LOAD_DEFAULT_DATABASE_CONFIG"]) return;
  array_map(function($table){$table->load();}, $tables);
  load_default_rows();
}

init_tables();