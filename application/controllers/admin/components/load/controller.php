<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods(["POST"]);

\db\components\autoload();

\request\response()
  ->setContent("success")
  ->send();
