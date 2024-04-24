<?php
\request\verify()
  ->allowed_methods(["GET"])
  ->require_params(["class_name"]);

ob_start();
if(isset($_GET['initializer'])){
  $content = \components()->get_instance($_GET["class_name"], $_GET['initializer']);
}else{
  $content = \components()->get_instance($_GET["class_name"]);
  // if(!isset($_GET['id'])) $content = \components()->get_instance($_GET["class_name"]);
  // else $content = unserialize(\db\pages\content\get_by_id($_GET['id'])['content']);
}
echo \components()->render($content);
$html = ob_get_clean();

\request\response()
  ->setContent($html)
  ->send();