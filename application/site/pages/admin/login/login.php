<?php
\admin()->logout();

$component = \component(__DIR__)
  ->css_file("login.css")
  ->js_file("login.js");
?>

<div class="<?=$component->identifiers()?>">
  <form class="inner form" action="javascript:login(`<?=$component->css_id()?>`)">
    <div class="input">
      <h1>Login to cms</h1>
    </div>
    <div class="input">
      <input type="text" placeholder="email@gmail.com" name="email-<?= $component->css_id() ?>" aria-label="email" required
      pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="invalid email address">
    </div>
    <div class="input">
      <input type="password" placeholder="********" name="password-<?= $component->css_id() ?>" aria-label="password" required
      pattern=".{3,32}" title="3-32 characters">
    </div>
    <div class="input">
      <button class="button" type="submit" aria-label="login">Login</button>
    </div>
  </form>
</div>
