<?php
$component = \component(__DIR__)
  ->css_file("components.css")
  ->js_file("components.js");
?>

<section class="<?=$component->identifiers()?>">
  <form action="javascript:add_component(`<?=$component->css_id()?>`)" id="create-component-<?=$component->css_id()?>" class="create-form form">
    <div class="input">
      <h2>Create Component</h2>
      <p style="
        font-size: 1rem;
        text-align: center;
        background-color: var(--color-error);
        padding:0.5rem;
        border-radius: 0.5rem">
        <strong>IMPORTANT</strong>
        <br>
        if you dont know what you are doing click "Auto load" and do not add or edit any components manually
        <!-- if you are missing components click auto load or add them manually if you know what you are doing -->
      </p>
    </div>
    <div class="input">
      <input type="text" placeholder="MyClass" name="class_name" aria-label="class_name"
      maxlength="255" title="class handled by functions" autocomplete="off" required>
    </div>
    <div class="input">
      <button type="submit">Create</button>
      <button class="info" type="button" onclick="auto_load_components()">Auto load</button>
    </div>
  </form>
  <?=\components()->render(\components()->get_instance("admin_components_form"));?>
</section>