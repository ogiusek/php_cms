<?php
require_once "include.php";
\admin()->admin_mode();
\component(__DIR__)
  ->js_file("admin.js");

\head()
  ->title("admin")
  ->description("admin panel")
  ->icon("/static/img/icons/logo_icon.svg")
  ->image("/static/img/icons/logo_icon.svg")
  ->echo();

if($_SESSION['route'] == "/admin/login"){
  require_once "login/login.php";
  return;
}
\admin()->auth();
ob_start();
require_once "admin_pages/index.php";
$content = ob_get_clean();
wrap_admin($content);
