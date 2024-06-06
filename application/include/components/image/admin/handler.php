<?php
$content = \components()->get_content();
$component = \components()->get_instance('image');

$component->set_src($content['image'] ?? $component->get_src());
$component->set_alt($content['alt'] ?? $component->get_alt());
$component->set_style(array_flat(array_merge(array_map(function ($e){
  if(!is_array($e)) return [];
  $e = array_flat($e);
  $e = array_filter($e, function($e) { return is_string($e); });
  return [key($e) => $e[key($e)]] ?? [];
}, $content['style[]'] ?? $component->get_style()))));

return $component;