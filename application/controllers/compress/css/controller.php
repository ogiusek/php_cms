<?php
\request\verify()
  ->allowed_methods(["GET"]);

header("Content-Type: text/css;");
echo $_SESSION["css"];
