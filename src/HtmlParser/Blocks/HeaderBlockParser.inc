<?php
namespace StructuredText\HtmlParser\Blocks;

use StructuredText\Block;

class HeaderBlockParser extends ContentBlock {

  function typeString() {
    return '.header';
  }

  public function canParseDomNode(\DOMNode $dom) {
    $allowed = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
    return in_array($dom->nodeName, $allowed);
  }

  protected function findAttributes(\DOMNode $node) {
    $attributes = new \stdClass();

    $attributes->depth = (int) substr($node->nodeName, 1, 1);

    return $attributes;
  }
}