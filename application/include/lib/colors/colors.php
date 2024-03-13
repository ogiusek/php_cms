<?php
namespace colors;
class IColors{
  public array $colors;
  public function __construct($colors = []){
    if(!is_array($colors)){
      $colors = [];
    }
    $this->colors = $colors;
    static $default_colors = [
      "bg-primary" => "#1c1e23",
      "shadow-primary" => "#222234",
      "btn-primary" => "#222234",
      "text-primary" => "#fffeee",
      "border-primary" => "#303841",
      "success" => "#28a745",
      "warning" => "#ffc107",
      "error" => "#dc3545",
      "info" => "#17a2b8",
    ];

    foreach ($default_colors as $key => $value) {
      $this->colors[$key] ??= $value;
    }
  }
};