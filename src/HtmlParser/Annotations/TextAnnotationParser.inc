<?php
namespace StructuredText\HtmlParser\Annotations;
use StructuredText\Annotation;
use StructuredText\HtmlParser\Parser;

class TextAnnotationParser implements AnnotationParser {

  static function register() {

  }

  static function canParseNode(\DOMNode $node) {
    return $node->nodeName === '#text';
  }

  public static function createAnnotationFromNode(\DOMNode $dom, $offset = 0, $parser = null) {
    $type = '.text';
    $length = strlen($dom->textContent);

    return new Annotation($type, $offset, $length);
  }

  public static function shouldPersist() {
    return false;
  }

}