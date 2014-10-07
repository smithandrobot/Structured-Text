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

  public function isEqual(Annotation $other) {
    return ($this->type === $other->type())
      && ($this->start === $other->start())
      && ($this->length === $other->length())
      && ($this->attributes === $other->attributes());
  }

  public function type() {
    return $this->type;
  }

  public function start() {
    return $this->start;
  }

  public function length() {
    return $this->length;
  }

  public function attributes() {
    return $this->attributes;
  }

  public function shift($offset) {
    $this->start += $offset;
  }

}