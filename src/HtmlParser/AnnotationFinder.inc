<?php
namespace StructuredText\HtmlParser;

class AnnotationFinder implements Finder {

  public function findMatches(\DOMNode $node, ParserCollection $collection) {
    $annotations = array();
    $offset = 0;

    foreach ($node->childNodes as $child) {
      $new_annotations = $this->getAnnotationsFromAnnotationNode($child, $collection, $offset);
      $annotations = array_merge($annotations, $new_annotations);
      $offset += strlen($child->textContent);
    }

    return $annotations;
  }

  protected function getAnnotationsFromAnnotationNode(\DOMNode $node, ParserCollection $collection, $offset = 0) {
    if ($node->nodeName === '#text') {
      return array();
    }

    $annotations = array();
    $handler = $collection->getParserForNode($node);

    if ($node->nodeName !== '#text' && $handler) {
      $annotation = $handler->createAnnotationFromNode($node, $offset);

      if ($annotation && $handler->shouldPersist()) {
        $annotations[] = $annotation;
      }
    }

    foreach ($node->childNodes as $child) {
      $subAnnotations = $this->getAnnotationsFromAnnotationNode($child, $collection, $offset);
      $annotations = array_merge($annotations, $subAnnotations);

      $offset += strlen($child->textContent);
    }

    return $annotations;
  }

}