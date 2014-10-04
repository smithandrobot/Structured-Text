<?php namespace StructuredText;

class Block {
  protected $type;
  protected $text;
  protected $attributes;
  protected $annotations;
  protected $children;

  public function __construct($type = null, $text = "", $attributes = array(), $annotations = array(), $children = array()) {
    $this->type = $type;
    $this->text = $text;
    $this->attributes = $attributes;
    $this->annotations = $annotations;
    $this->children = $children;
  }

  public function type() {
    return $this->type;
  }

  public function text() {
    return $this->text;
  }

  public function attributes() {
    return $this->attributes;
  }

  public function annotations() {
    return $this->annotations;
  }

  public function children() {
    return $this->children;
  }

  public function isEqual($other) {
    return ($this->type == $other->type) &&
    ($this->text == $other->text) &&
    ($this->attributes() == $other->attributes()) &&
    ($this->annotations() == $other->annotations()) &&
    ($this->children() == $other->children());
  }


}