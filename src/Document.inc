<?php namespace StructuredText;

class Document {

  var $scope;
  var $blocks;

  public function __construct($scope = "com.structured_text.core") {
    $this->scope = $scope;
    $this->blocks = array();
  }

  public function addBlock($block) {
    $this->blocks[] = $block;
  }

}