<?php
namespace StructuredText\HtmlParser\Blocks;
use StructuredText\HtmlParser\Parser;
use StructuredText\Block;

class ParagraphBlockParser implements BlockParser {

  function register(Parser $parser) {
    $parser->addBlockHandler($this);
  }

  function canParseDomElement(\DOMNode $dom) {
    return $dom->nodeName === 'p';
  }

  function createBlockFromDom(\DOMNode $node, $parser = null) {
    $type = ".paragraph";
    $text = $node->textContent;
    $attributes = array();
//    $attributes = self::findAttributes($node);
    $annotations = array();
    $children = array();
//    $children = self::findChildren($node);


    if ($parser) {
      $annotations = $parser->findAnnotations($node);
    }

    $block = new Block($type, $text, $attributes, $annotations, $children);
    return $block;
  }

  function findAttributes(\DOMNode $node) {
    return array();
  }

  function findChildren($dom) {
    return array();
  }

}
