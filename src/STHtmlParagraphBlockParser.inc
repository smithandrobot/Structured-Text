<?php
require_once 'STHtmlBlockParser.inc';
require_once 'STHtmlParser.inc';

class STHtmlParagraphBlockParser implements STHtmlBlockParser {

  static function canParseDomElement($dom) {
    return $dom->getName() === 'p';
  }

  static function createBlockFromDom($dom) {
    $type = ".paragraph";
    $text = (string)$dom;
    $attributes = self::findAttributes($dom);
    $annotations = self::findAnnotations($dom);
    $children = self::findChildren($dom);

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