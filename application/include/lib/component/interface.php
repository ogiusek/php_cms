<?php
namespace component;

interface IComponent {
  /**
   * attaches a js file to the component
   * @param string $path The path to the js file
   * @return self returns itself for chaining
   */
  function js_file(string $path): self;

  /**
   * attaches a css file to the component
   * @param string $path The path to the css file
   * @return self returns itself for chaining
   */
  function css_file(string $path): self;

  /**
   * returns unique component class
   * @return string returns css id
   */
  function css_id(): string;

  /**
   * returns the css classes of the component
   * @return string returns css classes
   */
  function identifiers(): string;

  /**
   * initializes the component
   * @param string $dir The directory of the component used for initialization and files
   */
  function __construct(string $dir);
};