<?php
namespace StructuredText\HtmlParser\Blocks;
use StructuredText\Block;

class GreedyBlockParser implements BlockParser {

  public function canParseDomNode(\DOMNode $node) {
    return true;
  }

  public function createBlockFromDom(\DOMNode $dom, $parser = null) {
    $type = '#'. $dom->nodeName;

    return new Block($type, $dom->textContent);
  }

}
