<?php
namespace StructuredText\HtmlParser\Blocks;
use StructuredText\Block;

abstract class ContentBlock implements BlockParser {

  abstract function typeString();

  function createBlockFromDom(\DOMNode $node, $parser = null) {
    if (!$this->canParseDomNode($node)) {
      return false;
    }

    $type = $this->typeString();
    $text = $node->textContent;
    $attributes = $this->findAttributes($node);

    if ($parser) {
      $annotations = $parser->findAnnotations($node);
    } else {
      $annotations = array();
    }

    $block = new Block($type, $text, $attributes, $annotations);
    return $block;
  }

  protected function findAttributes(\DOMNode $node) {
    return array();
  }

}