<?php
\request\verify()
  ->allowed_methods(["GET"]);

header("Content-Type: text/javascript;");
echo $_SESSION["js"];
