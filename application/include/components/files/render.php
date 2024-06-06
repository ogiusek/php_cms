<?php
$content = \components()->get_content();
$component = \component(__DIR__)
  ->css_file("files.css")
  ->js_file("files.js");

$dir = $_ENV['STATIC'].$content->dir;

$children = array_diff(scandir($dir), array('.'));
$files = array_filter($children, function($item) use ($dir) { return is_file($dir."/".$item); });
$directorys = array_filter($children, function($item) use ($dir) { return is_dir($dir."/".$item); });
function is_image(string $file){
  return preg_match("/\.(jpg|jpeg|png|gif|webp|svg)$/i", $file);
}
?>

<div class="<?= $component->identifiers() ?>" data-refresh="files" data-initializer="<?=$content->dir?>">
  <div class="dark-wrapper">
    <h3 class="above-shadow">Directorys</h3>
    <form class="form" action="javascript:void(0);" onsubmit="create_directory(this, '<?=$content->dir?>')">
      <div class="input">
        <label for="directory_name">directory name</label>
        <input type="text" data-name="directory_name" aria-label="directory_name" required>
      </div>
      <div class="input">
        <button type="submit">create</button>
      </div>
    </form>
    <ul class="directorys above-shadow">
    <?php foreach ($directorys as $file) {
      $path = $file === ".." ? dirname($content->dir) : $content->dir."/".$file;
      if($path === "") continue;
      $is_redirect = $file === "..";
      ?>
      <li class="directory dark-wrapper" data-addr="<?=$path === "/" ? "" : $path?>">
        <div class="input" style="width: 100%;">
          <button onclick="redirect_files_directory(this)" class="redirect"><?=$content->dir."/".$file?></button>
        </div>
        <?php if(!$is_redirect) { ?>
          <div class="input" style="width: unset">
            <button class="remove" onclick="remove_directory(this)">remove</button>
          </div>
        <?php } ?>
      </li>
    <?php } ?>
    </ul>
  </div>

  <div class="dark-wrapper">
    <h3 class="above-shadow">Files</h3>
    <form class="form" action="javascript:void(0);" onsubmit="upload_file(this, '<?=$content->dir?>')">
      <div class="input">
        <label for="file_name">file name</label>
        <input type="text" data-name="file_name" aria-label="file_name" required>
      </div>
      <div class="input">
        <label for="file">file</label>
        <input type="file" data-name="file" aria-label="file" required>
      </div>
      <div class="input">
        <button type="submit">upload</button>
      </div>
    </form>
    <ul class="files">
    <?php foreach ($files as $file) { ?>
      <li class="file dark-wrapper" data-addr="<?=$content->dir."/".$file?>">
        <?php if(is_image($file)){ ?>
          <div class="input" style="width: 100%;">
            <img src="/static/<?=$content->dir."/".$file?>" alt="<?=$content->dir."/".$file?>" style="max-width: 100%;max-height: 15rem;" />
          </div>
        <?php } else { ?>
          <div class="input" style="width: 100%;">
            <a href="/static/<?=$content->dir."/".$file?>" style="width: 100%;text-align: left" target="_blank"><?=$content->dir."/".$file?></a>
          </div>
        <?php } ?>
        <div class="input" style="width: unset">
          <button class="remove" onclick="remove_file(this)">remove</button>
        </div>
      </li>
    <?php } ?>
    </ul>
  </div>
</div>