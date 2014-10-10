<?php
namespace StructuredText\HtmlParser\Blocks;

use StructuredText\Block;

class ContainerBlockParser implements BlockParser {

  public function canParseDomElement(\DOMNode $dom) {
    return $dom->nodeName === 'div';
  }

  public function createBlockFromDom(\DOMNode $dom, $parser = null) {
    $type = '.container';
    $length = strlen($dom->textContent);

    return new Block($type, $dom->textContent);
  }

}