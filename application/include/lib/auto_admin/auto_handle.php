<?php
namespace auto_admin;

function admin_render(object $content): string{
  $class_vars = class_to_vars_types($content);
  ob_start();
  ?>
  <div>

  </div>
  <?php
  return ob_get_clean();
}
