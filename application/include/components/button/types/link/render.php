<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("link.css");
$data = $content->get_type_data() ?? [];
if(isset($data["href"])){
  $link = $data["href"];
} else if(isset($data["page-id"])){
  $pages = \db\pages\get_by_id($data["page-id"]);
  $link = $pages[0]["page"] ?? "#";
}else{
  $link = "#";
}
?>

<!-- <a class="<=$component->identifiers()?>" href="<=$data["href"]??"#" ?>"> -->
<a class="<?=$component->identifiers()?>" href="<?=format_link($link)?>">
  <?=$content->render_text()?>
</a>