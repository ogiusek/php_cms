<?php
namespace components;
require_once "interface.php";


class ComponentsImplementation implements IComponents {
  private string $class_file = "class.php";
  private string $handler_file = "admin/handler.php";
  private string $admin_file = "admin/render.php";
  private string $render_file = "render.php";
  private string $config_file = "config.json";

  private $content = null;
  public function get_component_name(string $class): string {
    $prefix = "components\\";
    if(substr($class, 0, strlen($prefix)) == $prefix)
      $class = substr($class, strlen($prefix));
    
    return $class;
  }

  public function set_content(mixed $content): self{
    $this->content = $content;
    return $this;
  }

  public function get_content(): mixed{
    return $this->content??0;
  }

  public function load_class(string $class_name): self {
    $file = $this->get_component_name($class_name)."/".$this->class_file;
    $file = __DIR__."/$file";
    if(file_exists($file))
      include_once $file;
    return $this;
  }

  public function get_instance(string $class_name, ...$params): mixed{
    $this->load_class($class_name);
    $class_name = "components\\$class_name";
    return new $class_name(...$params);
  }

  private function get_component_file(string $class_name, string $file){ return "$class_name/$file"; }

  private function render_file(string $class_name, string $file){
    $class_name = $this->get_component_name($class_name);
    $file = $this->get_component_file($class_name, $file);
    ob_start();
    include $file;
    $content = ob_get_clean();
    return $content;
  }

  private function render_file_with_content($content, string $file){
    if(is_string($content)){
      $class_name = get_class_of_serialized($content);
      $this->load_class($class_name);
      $content = unserialize($content);
    }else{
      $class_name = get_class($content);
    }
    $this->set_content($content);
    $content = $this->render_file($class_name, $file);
    return $content;
  }

  private function get_component_config(string $class_name){
    $class_name = $this->get_component_name($class_name);
    $config_file = $this->get_component_file($class_name, $this->config_file);
    $json = @json_decode(file_get_contents($config_file), true);
    if(!$json) $json = [];
    return $json;
  }

  private function auto_render_admin($content): string{
    if(is_string($content)){
      $class_name = get_class_of_serialized($content);
      $this->load_class($class_name);
      $content = unserialize($content);
    }
    return \auto_admin\admin_render($content);
  }

  private function auto_handler(string $class_name, mixed $content): object{
    return \auto_admin\admin_handle($class_name, $content);
  }

  public function render($content): string{
    return $this->render_file_with_content($content, $this->render_file);
  }

  public function admin_render($content): string{
    $config = $this->get_component_config(get_class_of_serialized($content));
    if($config["auto_admin"] ?? false)
      return $this->auto_render_admin($content);
    return $this->render_file_with_content($content, $this->admin_file);
  }

  public function use_controller(string $class_name, string $action): mixed{
    $this->load_class($class_name);
    $file = "controllers/$action/controller.php";
    if(!file_exists(__DIR__."/".$this->get_component_file($class_name, $file)))
      throw new \Exception("Controller not found");
      // return "controller not found";
    $data = $this->render_file($class_name, $file);
    $unserialized = @unserialize($data);
    return ($unserialized !== false) ? $unserialized : $data;
  }

  public function form_handler(string $class_name, mixed $content): object{
    $config = $this->get_component_config($class_name);
    if($config["auto_admin"] ?? false)
      return $this->auto_handler($class_name, $content);
    $class_name = $this->get_component_name($class_name);
    $this->load_class($class_name);

    $this->set_content($content);
    $handler_file = $this->get_component_name($class_name)."/".$this->handler_file;
    $response = (@include $handler_file);
    if($response == false || get_class($response) != "components\\$class_name")
      $response = $this->get_instance($class_name);

    return $response;
  }

  private function list_components_where(callable $filter_function): array{
    $components = [];
    $dir = __DIR__;
    $elements = scandir($dir);
    foreach($elements as $element){
      if(!is_file("$dir/$element/".$this->class_file) ||
         !is_file("$dir/$element/".$this->render_file)) continue;
         
      $config_file = "$dir/$element/".$this->config_file;
      $config_data = is_file($config_file) ? file_get_contents($config_file) : "[]";
      $config = json_decode($config_data, true);
      // $has_admin_files = !is_file("$dir/$element/".$this->admin_file) ||
      //                   !is_file("$dir/$element/".$this->handler_file);
      // if(!$has_admin_files && (!$config["auto_admin"]) ?? false) continue;
      if(!$filter_function($config)) continue;
      $config = json_decode(file_get_contents("$dir/$element/".$this->config_file), true);
      $components[] = $element;
    }
    return $components;
  }

  public function list_components(): array{
    static $components = null;
    if($components !== null) return $components;
    $components = $this->list_components_where(function($config){
      return $config["autoload"]??false;
    });
    // echo json_encode($components);
    return $components;
  }

  public function test(): array{
    $components = $this->list_components_where(function($config){
      return $config["test"]??false;
    });
    $response = array_map(function($component){
      $result = [
        "render" => true,
        "admin_render" => true,
        "form_handler" => true
      ];
      ob_start();
      try{
        \components()->render(\components()->get_instance($component));
      }catch(\Exception $e){
        $result["render"] = false;
      }
      try{
        \components()->admin_render(\components()->get_instance($component));
      }catch(\Exception $e){
        $result["admin_render"] = false;
      }
      try{
        \components()->form_handler($component, []);
      }catch(\Exception $e){
        $result["form_handler"] = false;
      }
      ob_get_clean();
      return [$component => $result];
    }, $components);
    $res = [];
    foreach($response as $item){
      $res = array_merge($res, $item);
    }
    return $res;
  }
};
