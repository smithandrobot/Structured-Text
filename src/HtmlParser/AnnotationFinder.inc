<?php
namespace StructuredText\HtmlParser;
use StructuredText\Annotation;
use StructuredText\HtmlParser\Annotations\AnnotationParser;

class AnnotationFinder {

  var $handlers;

  function __construct() {
    $this->handlers = array();
  }

  function register($parser) {
    $this->handlers[] = $parser;
  }

  function handlers() {
    return $this->handlers;
  }

  function getHandler(\DOMNode $node) {
    foreach ($this->handlers as $handler) {
      if ($handler::canParseNode($node)) {
        return $handler;
      }
    }
  }

  public function findAnnotations(\DOMNode $node) {
    $annotations = array();
    $offset = 0;

    foreach ($node->childNodes as $child) {
      $length = strlen($child->textContent);
      $handler = $this->getHandler($child);

      if ($handler) {
        $annotation = $handler::createAnnotationFromNode($child, $offset);
        $offset += $annotation->length();

        if ($handler::shouldPersist()) {
          $annotations[] = $annotation;
        }
      } else {
        $offset += $length;
      }
    }

    return $annotations;
  }

}