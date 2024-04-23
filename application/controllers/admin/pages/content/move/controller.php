<?php
\request\verify()
  ->allowed_methods(["PATCH"])
  ->require_params(["id", "after_id"]);

$id = $_POST["id"];
$after_id = $_POST["after_id"];
\db\pages\content\move_after($id, $after_id);

\request\response()
  ->setContent("Edited successfully!")
  ->send();
