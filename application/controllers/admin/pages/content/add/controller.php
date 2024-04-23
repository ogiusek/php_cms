<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods(["POST"])
  ->require_params(["page_id", "class_name"]);

$content = \components()->get_instance($_POST['class_name']);
if(!\db\pages\content\add($_POST['page_id'], serialize($content))){
  \request\response()
    ->setStatus(400)
    ->setContent("Error while adding content")
    ->send();
}

\request\response()
  ->setContent("Content added")
  ->send();