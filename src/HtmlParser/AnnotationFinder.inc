<?php
namespace StructuredText\HtmlParser;

class AnnotationFinder {

  protected $parsers;

  public function __construct(ParserCollection $parserCollection) {
    $this->parsers = $parserCollection;
  }

  public function findMatches(\DOMNode $node) {
    $annotations = array();
    $offset = 0;

    foreach ($node->childNodes as $child) {
      $subAnnotations = $this->getAnnotationsFromAnnotationNode($child, $offset);
      $annotations = array_merge($annotations, $subAnnotations);
      $offset += strlen($child->textContent);
    }

    return $annotations;
  }

  protected function getAnnotationsFromAnnotationNode(\DOMNode $node, $offset = 0) {
    if ($node->nodeName === '#text') {
      return array();
    }

    $annotations = array();
    if ($annotation = $this->getAnnotationForNode($node, $offset)) {
      $annotations[] = $annotation;
    }

    foreach ($node->childNodes as $child) {
      $subAnnotations = $this->getAnnotationsFromAnnotationNode($child, $offset);
      $annotations = array_merge($annotations, $subAnnotations);

      $offset += strlen($child->textContent);
    }

    return $annotations;
  }

  function getAnnotationForNode(\DOMNode $node, $offset) {
    $handler = $this->parsers->getParserForNode($node);

    if ($handler) {
      return $handler->createAnnotationFromNode($node, $offset);
    }

    return false;
  }

}