<?php
$content = \components()->get_content();

$page_id = $_SESSION['page_id'] ?? -1;
if($page_id != -1){
  $pallete = @\db\colors\get_by_page_id($page_id);
  $color = $pallete->colors["text-primary"];
}else{
  $color = "#000000";
}
$resouce_exists = file_exists($_ENV['STATIC'].$content->get_src());
$url_params = "url=".urlencode("/".$content->get_src())."&color=".urlencode($color);
$alt = $content->get_alt();
$alt = str_replace('"', "'", $alt);

$style = $content->get_style();
$style["height"] ??= "100%";
$style["width"] ??= "100%";
$style["object-fit"] ??= "contain";
$style = implode(";", array_map(function ($key, $value) {
  return "$key: $value";
}, array_keys($style), array_values($style)));
?>

<img
  <?php if($resouce_exists){ ?>
  src="/api/svg?<?=$url_params?>"
  <?php } ?>
  alt="<?=$alt?>"
  style="<?=$style?>"/>
