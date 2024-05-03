<?php
$component = \component(__DIR__)
  ->css_file("header.css")
  ->js_file("header.js");

$frontend_dropdown = \components()->get_instance("dropdown")
  ->setText("Frontend")
  ->setChildren([
    \components()->get_instance("dropdown")
      ->setText("Pages")
      ->setLink("/admin/frontend/pages"),
      \components()->get_instance("dropdown")
      ->setText("Components")
      ->setLink("/admin/frontend/components"),
      \components()->get_instance("dropdown")
      ->setText("Colors")
      ->setLink("/admin/frontend/colors")
  ]);

$backend_dropdown = \components()->get_instance("dropdown")
  ->setText("Backend")
  ->setChildren([
    \components()->get_instance("dropdown")
      ->setText("Posts(empty)")
      ->setLink("/admin/backend/posts"),
      \components()->get_instance("dropdown")
      ->setText("Emails(empty)")
      ->setLink("/admin/backend/emails")
  ]);

$settings_dropdown = \components()->get_instance("dropdown")
  ->setText("CMS")
  ->setChildren([
    \components()->get_instance("dropdown")
      ->setText("Files")
      ->setLink("/admin/cms/files"),
    \components()->get_instance("dropdown")
      ->setText("Users(empty)")
      ->setLink("/admin/cms/users"),
    \components()->get_instance("dropdown")
      ->setText("Test(empty)")
      ->setChildrenPos(["vertical" => "start", "horizontal" => "start", "bottom" => "100%", "left" => "100%"])
      ->setChildren([
        \components()->get_instance("dropdown")
          ->setText("Test")
          ->setLink("/admin/settings/test")
      ])
  ]);
?>

<header class="<?=$component->identifiers()?>">
  <nav>
    <ul class="row top">
      <li>
        <a class="logo" href="/admin" aria-label="logo" style="height: 1.5rem;">
          <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/logo.svg"))?>
        </a>
      </li>
      <li><a class="title" href="/admin" aria-label="title">cms</a></li>
      <li>
        <a class="logout" href="/admin/login" aria-label="logout" style="height: 1.5rem;">
          <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/logout.svg"))?>
        </a>
      </li>
    </ul>
    <hr>
    <ul class="row dropdowns">
      <li><?=\components()->render($frontend_dropdown)?></li>
      <li><?=\components()->render($backend_dropdown)?></li>
      <li><?=\components()->render($settings_dropdown)?></li>
    </div>
  </nav>
</header>