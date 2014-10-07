<?php
namespace StructuredText\HtmlParser;

class AnnotationFinder implements Finder {

  public function findMatches(\DOMNode $node, ParserCollection $collection) {
    $annotations = array();
    $offset = 0;

    foreach ($node->childNodes as $child) {
      $length = strlen($child->textContent);
      $handler = $collection->getParserForNode($child);

      if ($handler) {
        $annotation = $handler->createAnnotationFromNode($child, $offset);
        $offset += $annotation->length();

        if ($handler->shouldPersist()) {
          $annotations[] = $annotation;
        }
      } else {
        $offset += $length;
      }
    }

    return $annotations;
  }

}