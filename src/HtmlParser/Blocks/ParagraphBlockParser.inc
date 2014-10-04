<?php
namespace StructuredText\HtmlParser\Blocks;

class ParagraphBlockParser implements BlockParser {

  static function canParseDomElement(\DOMNode $dom) {
    return $dom->nodeName === 'p';
  }

  static function createBlockFromDom(\DOMNode $dom) {
    $type = ".paragraph";
    $text = $dom->textContent;
    $attributes = self::findAttributes($dom);
    $annotations = self::findAnnotations($dom);
    $children = self::findChildren($dom);

    print_r($dom->childNodes->length);

    foreach ($dom->childNodes as $child) {
      print_r('**'. $child->textContent);
    }

    $block = new \StructuredText\Block($type, $text, $attributes, $annotations, $children);
    return $block;
  }

  function findAttributes($dom) {
    return array();
  }

  function findAnnotations($dom) {
    return array();
  }

  function findChildren($dom) {
    return array();
  }

}

\StructuredText\HtmlParser\Parser::addHandler('StructuredText\HtmlParser\Blocks\ParagraphBlockParser');