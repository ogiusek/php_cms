<?php
  require_once dirname(realpath(__DIR__)) . '/include/include.php';
  require_once "site/display_site.php";

  function Something($arg = "") {
    ob_start();
    ?>
    <div>Something test <?= $arg ?></div>
    <?php
    return ob_get_clean();
  }
  function ping($arg = "") {
    ob_start();
    ?>
    <div><?= htmlspecialchars("<DISPLAY::Something cockers $arg />") ?>ping test <?= $arg ?></div>
    <!-- <div><?= Something("cockers $arg") ?>ping test <?= $arg ?></div> -->
    <?php
    return ob_get_clean();
  }
  function crack($arg = "") {
    ob_start();
    ?>
    <h1>crack test <?= $arg ?></h1>
    <?php
    return ob_get_clean();
  }


  ob_start();
  // require_once "lib/include.php";
  // require_once "components/include.php";
  // require_once "pages/include.php";
  echo "<h1>example site</h1>";
  echo htmlspecialchars("<DISPLAY::Something yoMam />");
  // echo Something("yoMam");
  echo htmlspecialchars("<DISPLAY::ping yoMama />");
  // echo ping("yoMama");
  echo htmlspecialchars("<DISPLAY::crack afta />");
  // echo crack("afta");
  echo "<style>h1{background-color: red;}</style>";
  echo "<style>div{background-color: green;}</style>";
  echo "<style>div{color: red;}</style>";
  echo "<style>div{padding: 10px;}</style>";
  echo "<style>h1{color: blue;}</style>";
  
  $app_content = ob_get_clean();
  $html = file_get_contents(__DIR__ . "/index.html");

  // require_once "site/display_site.php";
  echo display_site($html, $app_content);
  
  // echo $res;