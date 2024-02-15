<?php
  namespace display_site;
  function replace_app_with_app_content($html, $app_content) {
    $div_id_regex = "/<div id=\"app\">(.*?)<\/div>/s";
    if (preg_match($div_id_regex, $html, $div)) {
      $html = str_replace($div[0], $app_content, $html);
    }
    return $html;
  }



  function get_and_remove_all_tags($tag, $html){
    $regex = "/<{$tag}>(.*?)<\/{$tag}>/s";
    $tags_content = "";
    if (preg_match_all($regex, $html, $matches)) {
      foreach ($matches[1] as $key => $value) {
        $tags_content .= "\n" . $value;
      }
      foreach ($matches[0] as $key => $value) {
        $html = str_replace($value, "", $html);
      }
    }
    return array("html" => $html, "value" => $tags_content);
  }

  function move_tag_to($tag, $target, $html){
    $result = get_and_remove_all_tags($tag, $html);
    $html = $result["html"];
    $html = str_replace("</$target>", "<$tag>" . $result["value"] . "</$tag></$target>", $html);
    return $html;
  }

  function move_all_tags($html){
    $actions = array(
      function ($html) { return move_tag_to("style", "head", $html); },
      function ($html) { return move_tag_to("script", "body", $html); },
      function ($html) { return move_tag_to("head", "head", $html); },
    );
    foreach ($actions as $action) {
      $html = $action($html);
    }
    return $html;
  }