<?php
\request\verify()
  ->require_session_token();
?>

<li data-name="slides[]" class="li">
  <div class="input buttons">
    <button type="button" data-alt="remove" class="remove" onclick="select_parent_where(this, (e) => e.classList.contains('li')).remove();">
      <div style="width: 1rem;">
        <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/trash.svg")->set_alt("remove"))?>
      </div>
    </button>
  </div>
  <div data-name="image">
    <?=\components()->admin_render(\components()->get_instance("image"))?>
  </div>
  <div data-name="text">
    <?=\components()->admin_render(\components()->get_instance("text"))?>
  </div>
</li>