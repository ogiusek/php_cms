<?php
\request\verify()
  ->allowed_methods(["POST"])
  ->require_url_params(["component", "action"]);

$response = \components()->use_controller($_GET["component"], $_GET["action"]);

\request\response()
  ->setContent($response)
  ->send();