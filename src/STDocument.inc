<?php

class STDocument {

  var $scope;
  var $blocks;

  public function STDocument($scope = "com.structured_text.core") {
    $this->scope = $scope;
    $this->blocks = array();
  }

  public function addBlock($block) {
    $this->blocks[] = $block;
  }

}