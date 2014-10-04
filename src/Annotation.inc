<?php
namespace StructuredText;

class Annotation {

  protected $type;
  protected $start;
  protected $length;
  protected $attributes;

  public function __construct($type, $start, $length, $attributes = array()) {
    $this->type = $type;
    $this->start = $start;
    $this->length = $length;
    $this->attributes = $attributes;
  }

  public function type() {
    return $this->type;
  }


  public function attributes() {
    return $this->attributes;
  }

}