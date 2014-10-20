<?php
require 'vendor/autoload.php';
use StructuredText\Block;
use StructuredText\HtmlParser\BlockFinder;
use StructuredText\HtmlParser\ParserCollection;
use StructuredText\HtmlParser\Blocks\GreedyBlockParser;
use StructuredText\HtmlParser\Blocks\ParagraphBlockParser;

class BlockFinderTest extends PHPUnit_Framework_TestCase {

  function testInit() {
    $collectionMock = $this->getMock(ParserCollection::class);
    $finder = new BlockFinder($collectionMock);
    $this->assertNotNull($finder);
  }

  function testFindingOne() {
    $node = $this->getNodeForHTML('<p>Hello</p>', 'p');
    $collectionMock = $this->getMock(ParserCollection::class);
    $collectionMock->method('getParserForNode')
      ->will($this->returnValue(new ParagraphBlockParser()));
    $block = new Block('.paragraph', 'Hello');

    $finder = new BlockFinder($collectionMock);
    $result = $finder->findMatches($node);

    $this->assertTrue($block->isEqual($result));
  }

  function testFindingNested() {
    $node = $this->getNodeForHTML('<div><blockquote>Hello World</blockquote></div>', 'div');
    $collectionMock = $this->getMock(ParserCollection::class);
    $collectionMock->method('getParserForNode')
      ->will($this->returnValue(new GreedyBlockParser()));
    $block = new Block('#blockquote', 'Hello World');

    $finder = new BlockFinder($collectionMock);
    $result = $finder->findMatches($node);

    $this->assertEquals('#div', $result->type());
    $this->assertEquals('Hello World', $result->text());
    $this->assertCount(1, $result->children());
    $this->assertTrue($block->isEqual(current($result->children())));
  }


  function getNodeForHTML($html, $tag) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0);
  }
}