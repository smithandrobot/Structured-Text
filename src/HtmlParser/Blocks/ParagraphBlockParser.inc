<?php
namespace StructuredText\HtmlParser\Blocks;

class ParagraphBlockParser extends ContentBlock {

  function typeString() {
    return '.paragraph';
  }

  function canParseDomElement(\DOMNode $dom) {
    return $dom->nodeName === 'p';
  }

}
