<?php
namespace StructuredText\HtmlParser\Annotations;
use StructuredText\Annotation;

class LinkAnnotationParser implements AnnotationParser {

  public function typeString() {
    return '.link';
  }

  public function canParseDomNode(\DOMNode $node) {
    return $node->nodeName === 'a';
  }

  public function createAnnotationFromNode(\DOMNode $dom, $offset = 0, $parser = null) {
    $type = $this->typeString();
    $start = $offset;
    $length = strlen($dom->textContent);
    $attributes = $this->getAttributes($dom);

    return new Annotation($type, $start, $length, $attributes);
  }

  function getAttributes(\DomNode $node) {
    $attributes = new \stdClass();

    if ($node->getAttribute('href')) {
      $attributes->location = $node->getAttribute('href');
    }

    return $attributes;
  }

}
