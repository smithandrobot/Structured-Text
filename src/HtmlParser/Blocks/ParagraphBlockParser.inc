<?php
namespace StructuredText\HtmlParser\Blocks;

class ParagraphBlockParser extends ContentBlock {

  function typeString() {
    return '.paragraph';
  }

  function canParseDomNode(\DOMNode $dom) {
    return $dom->nodeName === 'p';
  }

}
