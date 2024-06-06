<?php
namespace components;
/**
 * IComponents is for rendering all component related elements like:
 * - component
 * - admin component editor
 * - admin component handler
 * - component controllers
 */
interface IComponents{
  /**
   * removes class prefix
   * @param string $class component class
   * @return string component name
   */
  function get_component_name(string $class_name): string;

  /**
   * created for setting content of component files
   * @param mixed $content component content
   * @return self
   */
  function set_content(mixed $content): self;

  /**
   * created for getting content of component files
   * @return mixed returns the content of rendered thing. should be used on top of any component file. 
   */
  function get_content(): mixed;

  /**
   * Get an instance of a specified class with optional parameters.
   * @param string $class_name The name of the class to instantiate.
   * @param mixed  ...$params Optional parameters to pass to the class constructor.
   * @return object|null An instance of the specified class or null if instantiation fails.
   */
  function get_instance(string $class_name, mixed ...$params): mixed;

  /**
   * Render the component.
   * @param mixed $content component content
   * @return string html
   */
  function render(mixed $content): string;

  /**
   * Render component edit form
   * @param mixed $content component content
   * @return string html
   */
  function admin_render(mixed $content): string;

  /**
   * Handle component edit form
   * @param string $class_name component name
   * @param mixed $content form data
   * @return object object
   */
  function form_handler(string $class_name, mixed $content): object;

  /**
   * Use one of the component controllers
   * @param string $class_name component name
   * @param string $action controller identifier
   * @return mixed controller response
   */
  function use_controller(string $class_name, string $action): mixed;

  /**
   * List all components
   * @return array list of components
   */
  function list_components(): array;

  /**
   * Load component class
   * @param string $class_name component name
   * @return self
   */
  function load_class(string $class_name): self;

  /**
   * test all components which has ["test": true] in their config 
   * @param string $class_name component name
   * @return array returns an array of test results with this structure:
   *  [
   *    "component_name" => [
   *      "class" => true|false,
   *      "render" => true|false,
   *      "admin_render" => true|false,
   *      "form_handler" => true|false
   *    ],
   *  ]
   */
  function test(): array;
};
