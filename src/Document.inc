<?php namespace StructuredText;

class Document implements \JsonSerializable {

  var $scope;
  var $blocks;

  public function __construct($scope = "com.structured_text.core") {
    $this->scope = $scope;
    $this->blocks = array();
  }

  public function addBlock($block) {
    $this->blocks[] = $block;
  }

  public function jsonSerialize() {
    return array(
      'scope' => $this->scope,
      'blocks' => $this->blocks,
    );
  }

}