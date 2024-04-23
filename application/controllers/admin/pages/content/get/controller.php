<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods(["GET"])
  ->require_params(["page_id"]);

ob_start();
$content = \components()->get_instance("admin_pages_content_form");
$content->page_id = $_POST["page_id"];
echo \components()->render($content);
$html = ob_get_clean();

\request\response()
  ->setContent($html)
  ->send();