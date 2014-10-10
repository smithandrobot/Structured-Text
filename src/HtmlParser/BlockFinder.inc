<?php
namespace StructuredText\HtmlParser;

class BlockFinder implements Finder {

  public function findMatches(\DOMNode $node, ParserCollection $collection) {
    $handler = $collection->getParserForNode($node);

    return array($handler->createBlockFromDom($node));
  }

}