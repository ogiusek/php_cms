<?php
\request\verify()
  ->require_session_token();
?>
<li data-name="dropdown[]" class="li">
  <div class="input" style="display: flex; flex-direction: row; gap: 1rem;">
    <button class="toggle" data-alt="toggle" onclick="select_parent_where(this, (e) => e.classList.contains('li'))
      .querySelector('.toggle-content').classList.toggle('hidden')">
      <div style="width: 1rem">
        <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/dropdown.svg")->set_alt("toggle"))?>
      </div>
    </button>
    <button onclick="this.parentElement.parentElement.remove()" class="remove">
      <div style="width: 1rem">
        <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/trash.svg")->set_alt("remove"))?>
      </div>
    </button>
  </div>
  <div class="toggle-content hidden">
    <?= \components()->admin_render(\components()->get_instance("button")) ?>
  </div>
</li>