<?php
namespace StructuredText\HtmlParser\Blocks;

class HeaderBlockParser implements BlockParser {

  public static function canParseDomElement(\DOMNode $dom) {
    $allowed = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
    return in_array($dom->nodeName, $allowed);
  }

  public static function createBlockFromDom(\DOMNode $dom, $parser) {

  }

}