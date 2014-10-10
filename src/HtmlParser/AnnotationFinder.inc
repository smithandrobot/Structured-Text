<?php
namespace StructuredText\HtmlParser;

class AnnotationFinder implements Finder {

  public function findMatches(\DOMNode $node, ParserCollection $collection) {
    $annotations = array();
    $offset = 0;

    foreach ($node->childNodes as $child) {
      $handler = $collection->getParserForNode($child);

      if ($child->nodeName !== '#text' && $handler) {
        $annotation = $handler->createAnnotationFromNode($child, $offset);
        $offset += $annotation->length();

        if ($handler->shouldPersist()) {
          $annotations[] = $annotation;
        }
      } else {
        $length = strlen($child->textContent);
        $offset += $length;
      }
    }

    return $annotations;
  }

}