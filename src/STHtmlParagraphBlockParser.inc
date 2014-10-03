<?php
require_once 'STHtmlBlockParser.inc';
require_once 'STHtmlParser.inc';
require_once 'STBlock.inc';

class STHtmlParagraphBlockParser implements STHtmlBlockParser {

  static function canParseDomElement(DOMNode $dom) {
    return $dom->nodeName === 'p';
  }

  static function createBlockFromDom(DOMNode $dom) {
    $type = ".paragraph";
    $text = $dom->textContent;
    $attributes = self::findAttributes($dom);
    $annotations = self::findAnnotations($dom);
    $children = self::findChildren($dom);

    print_r($dom->childNodes->length);

    foreach ($dom->childNodes as $child) {
      print_r('**'. $child->textContent);
    }

    $block = new STBlock($type, $text, $attributes, $annotations, $children);

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

STHtmlParser::addHandler(STHtmlParagraphBlockParser);