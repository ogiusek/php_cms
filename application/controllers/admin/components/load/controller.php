<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods(["PATCH"]);

\db\components\autoload();

\request\response()
  ->setContent("success")
  ->send();
