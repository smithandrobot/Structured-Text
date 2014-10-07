<?php
namespace StructuredText\HtmlParser\Blocks;

use StructuredText\Block;

class HeaderBlockParser implements BlockParser {

  public static function canParseDomElement(\DOMNode $dom) {
    $allowed = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
    return in_array($dom->nodeName, $allowed);
  }

  public static function createBlockFromDom(\DOMNode $dom, $parser = null) {
    if (!static::canParseDomElement($dom)) {
      return false;
    }

    $type = '.header';
    $attributes = self::findAttributes($dom);

    $block = new Block($type, null, $attributes);

    return $block;
  }

  protected static function findAttributes(\DOMNode $node) {
    $attributes = new \stdClass();

    $attributes->depth = (int) substr($node->nodeName, 1, 1);

    return $attributes;
  }
}