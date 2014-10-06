<?php
namespace StructuredText\HtmlParser\Blocks;
use StructuredText\HtmlParser\Parser;

class ParagraphBlockParser implements BlockParser {

  static function register(Parser $parser) {
    $parser->addBlockHandler(self::class);
  }

  static function canParseDomElement(\DOMNode $dom) {
    return $dom->nodeName === 'p';
  }

  static function createBlockFromDom(\DOMNode $node, $parser) {
    $type = ".paragraph";
    $text = $node->textContent;
    $attributes = array();
//    $attributes = self::findAttributes($node);
    $annotations = array(); // $parser->findAnnotations($node);
    $children = array();
//    $children = self::findChildren($node);

    $block = new \StructuredText\Block($type, $text, $attributes, $annotations, $children);
    return $block;
  }

  function findAttributes(\DOMNode $node) {
    return array();
  }

  function findChildren($dom) {
    return array();
  }

}

//\StructuredText\HtmlParser\Parser::addBlockHandler(ParagraphBlockParser::class);