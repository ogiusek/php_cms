<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods(["GET"])
  ->require_params(["class_name"]);

ob_start();
if(isset($_GET['initializer'])){
  $content = \components()->get_instance($_GET["class_name"], $_GET['initializer']);
}else{
  $content = \components()->get_instance($_GET["class_name"]);
}

echo \components()->admin_render($content);
$html = ob_get_clean();

\request\response()
  ->setContent($html)
  ->send();