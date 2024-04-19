<?php
\db\sessions\remove($_SESSION['session_token']);
unset($_SESSION['session_token']);

\request\response()
  ->setContent(["success" => true])
  ->send();
