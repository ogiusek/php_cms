<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods('POST')
  ->require_params(['page_id', 'content_id']);

$copied_id = $_POST['content_id'];
$element = \db\pages\content\get_by_id($copied_id)[0] ?? null;
if ($element === null) {
  \request\response()
    ->setStatus(400)
    ->setContent("Element do not exists")
    ->send();
}

$content = $element['content'];
$page_id = $_POST['page_id'];
\db\pages\content\add($page_id, $content);

\request\response()
  ->setContent("Pasted element")
  ->send();