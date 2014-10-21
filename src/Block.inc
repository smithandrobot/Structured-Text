<?php namespace StructuredText;

class Block implements \JsonSerializable {
  protected $type;
  protected $text;
  protected $attributes;
  protected $annotations;
  protected $children;
  protected $depth;

  public function __construct($type = null, $text = "", $attributes = array(), $annotations = array(), $children = array(), $depth = 0) {
    $this->type = $type;
    $this->text = $text;
    $this->attributes = $attributes;
    $this->annotations = $annotations;
    $this->children = $children;
    $this->depth = $depth;
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

  public function depth() {
    return $this->depth;
  }

  public function isEqual($other) {
    return ($this->type == $other->type)
      && ($this->text == $other->text)
      && ($this->attributes() == $other->attributes())
      && ($this->annotations() == $other->annotations())
      && ($this->children() == $other->children())
      && ($this->depth() == $other->depth());
  }


  public function newBlockWithChildren(array $children) {
    return new Block($this->type, $this->text, $this->attributes, $this->annotations, $children);
  }

  public function jsonSerialize() {
    return array(
      'type' => $this->type,
      'text' => $this->text,
      'attributes' => $this->attributes,
      'annotations' => $this->annotations,
      'children' => $this->children,
    );
  }
}