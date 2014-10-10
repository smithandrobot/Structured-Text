<?php
require 'vendor/autoload.php';
use StructuredText\Block;
use StructuredText\HtmlParser\BlockFinder;
use StructuredText\HtmlParser\ParserCollection;
use StructuredText\HtmlParser\Blocks\ParagraphBlockParser;

class BlockFinderTest extends PHPUnit_Framework_TestCase {

  function testInit() {
    $finder = new BlockFinder();
    $this->assertNotNull($finder);
  }

  function testFindingOne() {
    $node = $this->getNodeForHTML('<p>Hello</p>', 'p');
    $collectionMock = $this->getMock(ParserCollection::class);
    $collectionMock->method('getParserForNode')
      ->will($this->returnValue(new ParagraphBlockParser()));
    $block = new Block('.paragraph', 'Hello');

    $finder = new BlockFinder();
    $blocks = $finder->findMatches($node, $collectionMock);

    $this->assertCount(1, $blocks);
    $this->assertTrue($block->isEqual($blocks[0]));
  }


  function getNodeForHTML($html, $tag) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0);
  }
}