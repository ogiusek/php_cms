<?php
namespace request;
function verify() { return new \request\verify\IVerify(); }

namespace request\verify;

class IVerify {
  public function allowed_methods($allowed_methods): self {
    if(is_string($allowed_methods)) $allowed_methods = [$allowed_methods];
    $request_method = $_SERVER['REQUEST_METHOD'];
    if (!in_array($request_method, $allowed_methods)) {
      \request\response()
        ->setStatus(405)
        ->setContent("$request_method method is not allowed")
        ->send();
    }
    return $this;
  }

  public function require_params(array $required_params): self {
    foreach ($required_params as $param) {
      if (!isset($_POST[$param])) {
        \request\response()
          ->setStatus(400)
          ->setContent("'$param' parameter is missing")
          ->send();
      }
    }
    return $this;
  }

  public function require_url_params(array $required_params): self {
    foreach ($required_params as $param) {
      if (!isset($_GET[$param])) {
        \request\response()
          ->setStatus(400)
          ->setContent("'$param' url parameter is missing")
          ->send();
      }
    }
    return $this;
  }

  public function require_session_token(): self {
    $session_token = $_SESSION['session_token'] ?? null;
    if ($session_token == null) {
      \request\response()
        ->setStatus(401)
        ->setContent("Session token is missing")
        ->send();
    }

    $user_id = \db\sessions\get_user_id($session_token);
    if ($user_id == null) {
      \request\response()
        ->setStatus(401)
        ->setContent("Invalid session token")
        ->send();
    }
    return $this;
  }
};