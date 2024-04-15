<?php
namespace request;

function response(): \request\response\IResponse { return new \request\response\IResponse(); }

namespace request\response;

class IResponse{
  private int $status = 200;
  function setStatus(int $status): self{
    if($status >= 400 && $status < 600) $this->isError();
    $this->status = $status;
    return $this;
  }

  private bool $error = false;
  function isError(bool $error = true): self{
    $this->error = $error;
    return $this;
  }

  private $content = "";
  function setContent($data): self{
    $this->content = $data;
    return $this;
  }
  
  private string $header = "Content-Type: application/json";
  function setHeader(string $header): self{
    $this->header = $header;
    return $this;
  }

  function send_without_exit() {
    if(responded()) return;

    http_response_code($this->status);
    header($this->header);
  
    echo json_encode([
      "content" => $this->content,
      "error" => $this->error
    ]);
  }
  function send() {
    $this->send_without_exit();
    exit();
  }
};

function responded(): bool{
  static $responded = false;
  if($responded) {
    return true;
  }
  $responded = true;
  return false;
}