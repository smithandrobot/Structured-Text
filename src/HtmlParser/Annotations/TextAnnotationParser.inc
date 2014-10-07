<?php
namespace StructuredText\HtmlParser\Annotations;
use StructuredText\Annotation;
use StructuredText\HtmlParser\Parser;

class TextAnnotationParser implements AnnotationParser {

  public function register() {

  }

  public function canParseNode(\DOMNode $node) {
    return $node->nodeName === '#text';
  }

  public function createAnnotationFromNode(\DOMNode $dom, $offset = 0, $parser = null) {
    $type = '.text';
    $length = strlen($dom->textContent);

    return new Annotation($type, $offset, $length);
  }

  public function shouldPersist() {
    return false;
  }

}