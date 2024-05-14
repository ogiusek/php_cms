<?php
$component = \component(__DIR__)
  ->css_file("header.css")
  ->js_file("header.js");

$frontend_dropdown = \components()->get_instance("button")
  ->set_text("Frontend")
  ->set_type("dropdown", [
    "children" => [
      \components()->get_instance("button")
        ->set_text("Pages")
        ->set_type("link", [ "href" => "/admin/frontend/pages" ]),
      \components()->get_instance("button")
        ->set_text("Components")
        ->set_type("link", [ "href" => "/admin/frontend/components" ]),
      \components()->get_instance("button")
        ->set_text("Colors")
        ->set_type("link", [ "href" => "/admin/frontend/colors" ])
    ]
  ]);

$backend_dropdown = \components()->get_instance("button")
  ->set_text("Backend")
  ->set_type("dropdown", [
    "children" => [
      \components()->get_instance("button")
        ->set_text("Posts(empty)")
        ->set_type("link", [ "href" => "/admin/backend/posts" ]),
      \components()->get_instance("button")
        ->set_text("Emails(empty)")
        ->set_type("link", [ "href" => "/admin/backend/emails" ])
    ]
  ]);

$settings_dropdown = \components()->get_instance("button")
  ->set_text("CMS")
  ->set_type("dropdown", [
    "children" => [
      \components()->get_instance("button")
        ->set_text("Files")
        ->set_type("link", [ "href" => "/admin/cms/files" ]),
      \components()->get_instance("button")
        ->set_text("Users(empty)")
        ->set_type("link", [ "href" => "/admin/cms/users" ]),
      \components()->get_instance("button")
        ->set_text("Test(empty)")
        ->set_type("dropdown", [
          "children" => [
            \components()->get_instance("button")
              ->set_text("Test")
              ->set_type("link", [ "href" => "/admin/settings/test" ])
          ]
        ])
      ]
  ]);
?>

<header class="<?=$component->identifiers()?>">
  <nav>
    <ul class="row top">
      <li>
        <a class="logo" href="/admin" aria-label="logo" style="height: 1.5rem;">
          <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/logo.svg")->set_alt("logo"))?>
        </a>
      </li>
      <li><a class="title" href="/admin" aria-label="title">cms</a></li>
      <li>
        <a class="logout" href="/admin/login" aria-label="logout" style="height: 1.5rem;">
          <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/logout.svg")->set_alt("logout"))?>
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