<?php
namespace StructuredText\HtmlParser;

class AnnotationFinder implements Finder {

  public function findMatches(\DOMNode $node, ParserCollection $collection) {
    $annotations = array();
    $offset = 0;

    foreach ($node->childNodes as $child) {
      $subAnnotations = $this->getAnnotationsFromAnnotationNode($child, $collection, $offset);
      $annotations = array_merge($annotations, $subAnnotations);
      $offset += strlen($child->textContent);
    }

    return $annotations;
  }

  protected function getAnnotationsFromAnnotationNode(\DOMNode $node, ParserCollection $collection, $offset = 0) {
    if ($node->nodeName === '#text') {
      return array();
    }

    $annotations = array();
    if ($annotation = $this->getAnnotationForNode($node, $collection, $offset)) {
      $annotations[] = $annotation;
    }

    foreach ($node->childNodes as $child) {
      $subAnnotations = $this->getAnnotationsFromAnnotationNode($child, $collection, $offset);
      $annotations = array_merge($annotations, $subAnnotations);

      $offset += strlen($child->textContent);
    }

    return $annotations;
  }

  function getAnnotationForNode(\DOMNode $node, ParserCollection $collection, $offset) {
    $handler = $collection->getParserForNode($node);

    if ($handler) {
      $annotation = $handler->createAnnotationFromNode($node, $offset);
    }

    if ($annotation && $handler->shouldPersist()) {
      return $annotation;
    }

    return false;
  }

}