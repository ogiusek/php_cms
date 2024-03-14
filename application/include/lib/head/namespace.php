<?php
namespace head;

class IHead {

  public function echo() {
    $head = "";
    $head .= "<link rel=\"icon\" href=\"$this->icon\">";
    $head .= "<meta property=\"og:image\" content=\"$this->image\">";
    $head .= "<meta property=\"og:title\" content=\"$this->title\">";
    $head .= "<title>$this->title</title>";
    $head .= "<meta name=\"description\" content=\"$this->description\">";
    $head .= "<meta property=\"og:description\" content=\"$this->description\">";
    $head .= "<meta name=\"keywords\" content=\"$this->keywords\">";
    
    echo "<head>$head</head>";
  }

  public string $icon = "";
  public function icon(string $icon): self {
    // $this->head .= "<link rel=\"icon\" href=\"$icon\">";
    $this->icon = $icon;
    return $this;
  }

  public string $image = "";
  public function image(string $image): self {
    // $this->head .= "<meta property=\"og:image\" content=\"$image\">";
    $this->image = $image;
    return $this;
  }

  public string $title = "";
  public function title(string $title): self {
    // $this->head .= "<meta property=\"og:title\" content=\"$title\">";
    // $this->head .= "<title>$title</title>";
    $this->title = $title;
    return $this;
  }

  public string $description = "";
  public function description(string $description): self {
    // $this->head .= "<meta name=\"description\" content=\"$description\">";
    // $this->head .= "<meta property=\"og:description\" content=\"$description\">";
    $this->description = $description;
    return $this;
  }

  public string $keywords = "";
  public function keywords(string $keywords): self {
    // $this->head .= "<meta name=\"keywords\" content=\"$keywords\">";
    $this->keywords = $keywords;
    return $this;
  }
}