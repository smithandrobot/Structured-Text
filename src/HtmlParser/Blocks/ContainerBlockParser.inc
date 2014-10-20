<?php
namespace StructuredText\HtmlParser\Blocks;

use StructuredText\Block;

class ContainerBlockParser implements BlockParser {

  public function canParseDomElement(\DOMNode $dom) {
    return $dom->nodeName === 'div';
  }

  public function createBlockFromDom(\DOMNode $dom, $parser = null) {
    $type = '.container';

    return new Block($type);
  }

}