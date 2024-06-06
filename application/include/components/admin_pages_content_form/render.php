<?php
$component = \component(__DIR__)
  ->css_file("admin_pages_content_form.css")
  ->js_file("admin_pages_content_form.js");
$content = \components()->get_content();
$page_id = $content->page_id;
?>
<div class="<?=$component->identifiers()?>" data-refresh="admin_pages_content_form" data-initializer="<?=$page_id?>">
  <h2>page content</h2>
  <form class="content-add-form form" action="javascript:void(0)" onsubmit="add_page_content(this, <?=$page_id?>)">
    <div class="input">
      <label for="class_name">component class</label>
      <select name="class_name" aria-label="class_name">
        <option value="" disabled selected>-- select --</option>
        <?php
        $components = \db\components\get();
        foreach($components as $component) { ?>
          <option value="<?=$component['class_name']?>"><?=$component['class_name']?></option>
        <?php } ?>
      </select>
    </div>
    <div class="input button">
      <button type="submit">add</button>
      <button type="button" class="paste" onclick="paste_page_content('<?=$page_id?>')" data-alt="paste">
        <div style="width: 1rem">
          <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/paste.svg")->set_alt("paste"))?>
        </div>
      </button>
    </div>
  </form>

  <ul class="content-list">
  <?php
  $contents = \db\pages\content\get_by_page_id($page_id);  
  foreach($contents as $content) {
    $element_id = "content-". $content['id'];
    $content_obj = $content['content'];
    $title = get_class_of_serialized($content_obj);
    $title = \components()->get_component_name($title); ?>
    <li id="<?=$element_id?>" data-id="<?=$content['id']?>" class="content-item draggable" ondragend="change_page_content_order('<?=$element_id?>')">
      <div style="display: flex; justify-content: space-between; flex-direction: row">
        <h3><?=$title?></h3>
        <div class="input button buttons">
          <button class="toggle" data-alt="toggle" onclick="this.parentElement.parentElement.parentElement.querySelector('.toggle-content').classList.toggle('hidden')">
            <div style="width: 1rem">
              <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/dropdown.svg")->set_alt("toggle"))?>
            </div>
          </button>
          <button class="copy" data-alt="copy" onclick="copy_page_content('<?= $content['id'] ?>')">
            <div style="width: 1rem">
              <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/copy.svg")->set_alt("copy"))?>
            </div>
          </button>
          <button class="drag-btn" data-alt="drag" onmouseup="drag_once(document.getElementById('<?=$element_id?>'))">
            <div style="width: 1rem">
              <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/move.svg")->set_alt("drag"))?>
            </div>
          </button>
          <button class="edit" data-alt="save" onclick="edit_page_content(<?=$content['id']?>, '<?=$element_id?>')">
            <div style="width: 1rem">
              <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/save.svg")->set_alt("save"))?>
            </div>
          </button>
          <button class="remove" data-alt="remove" onclick="remove_page_content(<?=$content['id']?>, '<?=$element_id?>')">
            <div style="width: 1rem">
              <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/trash.svg")->set_alt("remove"))?>
            </div>
          </button>
        </div>
      </div>
      <div class="toggle-content hidden">
        <?php try{ ?>
          <?=\components()->admin_render($content_obj);?>
        <?php }catch(Throwable $e){ ?>
          <h4 class="error">Cannot render this component</h4>
        <?php } ?>
      </div>
    </li>
  <?php } ?>
  </ul>
</div>