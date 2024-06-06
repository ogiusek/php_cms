<?php
$component = \component(__DIR__)
  ->css_file("admin_pages_form.css")
  ->js_file("admin_pages_form.js");

$pages = \db\pages\get(true); // add element to start of pages
?>
<ul class="<?=$component->identifiers()?>" data-refresh="admin_pages_form">
<?php foreach($pages as $page) { ?>
  <li>
    <form class="edit-page-form form" action="javascript:edit_page(`<?=$page['id']?>`)" data-id="<?=$page['id']?>">
      <div class="row">
        <div class="input">
          <label for="page">page</label>
          <input type="text" placeholder="main page" name="page" class="page-name" aria-label="page name" required
          maxlength="255" title="Page address" value="<?=$page['page']?>">
        </div>
        <div class="input" style="display: none">
          <label for="file">file</label>
          <input type="text" placeholder="start/start.php" name="file" class="page-file" aria-label="page file" required
          maxlength="255" title="Path to file" value="<?=$page['file']?>">
        </div>
        <div class="input" style="display: none">
          <label for="order">order</label>
          <input type="number" name="order" class="page-order" aria-label="page order" required
          value="<?=$page['order']?>" title="Order">
        </div>
      </div>
      <div class="row" style="justify-content: end; margin-left: auto">
        <div class="input button">
          <button type="submit" data-alt="save">
            <div style="width: 1rem">
              <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/save.svg")->set_alt("save"))?>
            </div>
          </button>
          <a class="preview" data-alt="preview" href="<?=format_link($page['page'])?>" target="_blank">
            <div style="width: 1rem">
              <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/preview.svg")->set_alt("preview"))?>
            </div>
          </a>
          <button type="button" data-alt="remove" class="remove" onclick="delete_page(`<?=$page['id']?>`)">
            <div style="width: 1rem">
              <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/trash.svg")->set_alt("remove"))?>
            </div>
          </button>
        </div>
      </div>
      <div class="page-content">
        <div class="input button">
          <button type="button" class="content-btn" onclick="toggle_edit_page_content(`<?=$page['id']?>`)">content</button>
        </div>
      </div>
    </form>
    <div class="page-content-editor" id="page-content-<?=$page['id']?>">
      <?=\components()->render(\components()->get_instance("admin_header_form", $page['id']))?>

      <?=\components()->render(\components()->get_instance("admin_pages_content_form", $page['id']));?>
    </div>
  </li>
<?php } ?>
</ul>