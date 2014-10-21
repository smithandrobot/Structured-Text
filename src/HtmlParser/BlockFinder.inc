<?php
namespace StructuredText\HtmlParser;

class BlockFinder {

  protected $parsers;

  public function __construct(ParserCollection $parserCollection) {
    $this->parsers = $parserCollection;
  }

  public function findMatches(\DOMNode $node, $parser = null) {
    return $this->getBlocksForNode($node, $parser);
  }

  protected function getChildBlocks(\DOMNode $node, $parser = null) {
    $blocks = array();
    foreach ($node->childNodes as $child) {
      if ($new_blocks = $this->getBlocksForNode($child, $parser)) {
        $blocks = array_merge($blocks, $new_blocks);
      }
    }

    return $blocks;
  }

  protected function getBlocksForNode(\DOMNode $node, $parser = null) {
    if ($node->nodeName == '#text') {
      return false;
    }

    if ($handler = $this->parsers->getParserForNode($node)) {
      $block = $handler->createBlockFromDom($node, $parser);

      if ($node->childNodes) {
        $childrenBlocks = $this->getChildBlocks($node, $parser);
        $block = $block->newBlockWithChildren($childrenBlocks);
      }

      return array($block);
    } else {
      $blocks = $this->getChildBlocks($node, $parser);
      return $blocks;
    }

    return false;
  }
}