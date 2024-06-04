<?php
\request\verify()
  ->require_session_token();
?>
<li class="li" data-name="children[]">
  <div class="input buttons">
    <button type="button" data-alt="toggle" class="toggle" onclick="select_parent_where(this, (e) => e.classList.contains('li')).classList.toggle('show');">
      <div style="width: 1rem">
        <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/dropdown.svg")->set_alt("toggle"))?>
      </div>
    </button>
    <button type="button" data-alt="remove" class="remove" onclick="select_parent_where(this, (e) => e.classList.contains('li')).remove();">
      <div style="width: 1rem">
        <?=\components()->render(\components()->get_instance("image")->set_src("/img/icons/trash.svg")->set_alt("remove"))?>
      </div>
    </button>
  </div>
  <div>
    <?=\components()->admin_render(\components()->get_instance("button"))?>
  </div>
</li>