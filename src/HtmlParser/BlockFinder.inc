<?php
namespace StructuredText\HtmlParser;

class BlockFinder {

  protected $parsers;

  public function __construct(ParserCollection $parserCollection) {
    $this->parsers = $parserCollection;
  }

  public function findMatches(\DOMNode $node) {
    return $this->getBlockForNode($node);
  }

  protected function getChildBlocks(\DOMNode $node) {
    $blocks = array();
    foreach ($node->childNodes as $child) {
      if ($block = $this->getBlockForNode($child)) {
        $blocks[] = $block;
      }
    }

    return $blocks;
  }

  protected function getBlockForNode(\DOMNode $node) {
    if ($node->nodeName == '#text') {
      return false;
    }

    if ($handler = $this->parsers->getParserForNode($node)) {
      $block = $handler->createBlockFromDom($node);

      if ($node->childNodes) {
        $childrenBlocks = $this->getChildBlocks($node);
        $block = $block->newBlockWithChildren($childrenBlocks);
      }

      return $block;
    }

    return false;
  }
}