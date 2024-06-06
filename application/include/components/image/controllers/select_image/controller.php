<?php
\request\verify()
  ->require_session_token()
  ->require_params(["directory"]);

$dir = $_POST["directory"];
$dir = $dir === "" ? "/img" : $dir;
$dir = $dir === "/" ? "" : $dir;
$full_dir = $_ENV["STATIC"]."/$dir";
$component = \component(__DIR__)
  ->css_file("style.css");
?>
<?php
function is_image($file) {
  return preg_match("/\.(jpg|jpeg|png|gif|webp|svg)$/i", $file);
}
?>

<div class="<?=$component->identifiers()?>" data-refresh="image-controller">
  <div class="input" style="margin-left: auto; width: min-content">
    <button type="button" data-alt="exit" type="button" onclick="admin_image_component_exit(select_parent_component(this))"><img alt="exit" src="/static/img/icons/close.svg"/></button>
  </div>
  <!-- TODO <form action="javascript:void(0)" onsubmit="console.log('cock')" style="
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;">
    <h4>upload image</h4>
    <div class="input">
      <label for="image">image</label>
      <input type="file" accept="image/*" data-name="image" required>
    </div>
    <div class="input">
      <button type="submit">add</button>
    </div>
  </form> -->
  <?php $contents = scandir($full_dir); ?>
  <?php $contents = array_diff($contents, array('.')); ?>
  <?php if (empty($dir)) $contents = array_diff($contents, array('..')); ?>
  <?php $directorys = array_filter($contents, function($item) use ($full_dir) { return is_dir($full_dir."/".$item); }); ?>
  <ul class="directorys">
    <?php foreach($directorys as $content) { ?>
      <?php $content = "$dir/$content" ?>
      <?php $content = substr($content, -2) == '..' ? dirname(dirname($content)) : $content; ?>
      <li>
        <button type="button" onclick="admin_image_select_directory('<?= $content ?>', select_parent_component(this))"><?=$content?></button>
      </li>
    <?php } ?>
  </ul>
  <?php $images = array_filter($contents, function($item) use ($full_dir) { return is_image($full_dir."/".$item); }); ?>
  <ul class="images">
    <?php foreach($images as $content) { ?>
      <?php $content = "$dir/$content"; ?>
      <li>
        <button type="button" onclick="admin_image_select_image('<?= $content ?>', select_parent_component(this))">
          <img src="/static/<?=$content?>" alt="<?= $content ?>">
        </button>
      </li>
    <?php } ?>
  </ul>
</div>
