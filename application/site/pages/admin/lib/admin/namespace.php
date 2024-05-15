<?php
namespace admin;
class IAdmin {
  public function admin_mode(): self {
    if(!$_ENV["ENABLE_ADMIN"]) {
      header("Location: /");
      exit();
    }
    return $this;
  }

  private function auth_require_session_token(): self {
    $session_token = $_SESSION['session_token'] ?? null;
    if ($session_token == null) {
      header("Location: /admin/login");
      exit();
    }
    $user_id = \db\sessions\get_user_id($session_token);
    if ($user_id == null) {
      header("Location: /admin/login");
      exit();
    }
    return $this;
  }

  public function auth(): self {
    return $this
      ->auth_require_session_token();
  }

  public function logout(): self {
    unset($_SESSION['session_token']);
    return $this;
  }
}