<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods("PUT")
  ->require_params(["page_id", "color_palette", "description", "icon", "image", "keywords", "title"]);

$head = (new \head\IHead())
  ->description($_POST['description'])
  ->icon($_POST['icon'])
  ->image($_POST['image'])
  ->keywords($_POST['keywords'])
  ->title($_POST['title']);
$head = new \db\pages\head\IHead($head, $_POST['color_palette']);
\db\pages\head\update($_POST['page_id'], $head);

\request\response()
  ->setContent("Successfully updated page head.")
  ->send();