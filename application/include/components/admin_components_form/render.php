<?php
$component = \component(__DIR__)
  ->css_file("admin_components_form.css")
  ->js_file("admin_components_form.js");

$components = \db\components\get(); ?>
<ul class="<?=$component->identifiers()?>" data-refresh="admin_components_form">
  <?php foreach($components as $component_element) { ?>
  <li>
    <form class="edit-form form" action="javascript:edit_component(`<?=$component_element['id']?>`)" data-id="<?=$component_element['id']?>">
      <div class="input">
        <label for="class_name">class name</label>
        <input type="text" placeholder="MyClass" name="class_name" aria-label="class_name" required
          maxlength="255" title="class handled by functions" value="<?=$component_element['class_name']?>">
      </div>
      <div class="input button">
        <button type="submit" data-alt="save">
          <div style="width: 1rem">
            <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/save.svg")->set_alt("save"))?>
          </div>
        </button>
        <button type="button" data-alt="remove" class="remove" onclick="delete_component(`<?=$component_element['id']?>`, `<?=$component->css_id()?>`)">
          <div style="width: 1rem">
            <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/trash.svg")->set_alt("remove"))?>
          </div>
        </button>
      </div>
    </form>
  </li>
  <?php } ?>
</ul>