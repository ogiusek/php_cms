<?php
\request\verify()
  ->require_session_token()
  ->allowed_methods("PUT")
  ->require_params(["page_id", "color_palette", "description", "icon", "image", "keywords", "title"]);

$head = (new \head\IHead())
  ->description($_POST['description'])
  // ->icon($_POST['icon'])
  ->icon(\components()->form_handler("image", $_POST['icon'])->get_src())
  // ->image($_POST['image'])
  ->image(\components()->form_handler("image", $_POST['image'])->get_src())
  ->keywords($_POST['keywords'])
  ->title($_POST['title']);
$head = new \db\pages\head\IHead($head, $_POST['color_palette']);
\db\pages\head\update($_POST['page_id'], $head);

\request\response()
  ->setContent("Successfully updated page head.")
  ->send();