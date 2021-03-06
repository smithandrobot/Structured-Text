<?php
namespace StructuredText\HtmlParser\Annotations;
use StructuredText\Annotation;
use StructuredText\HtmlParser\Parser;

class GreedyAnnotationParser implements AnnotationParser {

  public function canParseDomNode(\DOMNode $node) {
    return true;
  }

  public function createAnnotationFromNode(\DOMNode $dom, $offset = 0, $parser = null) {
    $type = '*'. $dom->nodeName;
    $length = strlen($dom->textContent);

    return new Annotation($type, $offset, $length);
  }

}