<?php

use StructuredText\HtmlParser\ParserCollection;
use StructuredText\HtmlParser\Blocks\BlockParser;
use StructuredText\HtmlParser\AnnotationFinder;

class ParserCollectionTest extends PHPUnit_Framework_TestCase {

  function testInit() {
    $collection = new ParserCollection();
    $this->assertNotNull($collection);
  }

  function testRegistration() {
    $collection = new ParserCollection();
    $collection->registerParser(\StructuredText\HtmlParser\Annotations\BoldAnnotationParser::class);

    $this->assertCount(1, $collection->parsers());
  }

  function testCanFindHandler() {
    $parser = $this->getMock(BlockParser::class);
    $parser->method('canParseDomElement')
      ->will($this->returnValue(true));
    $collection = new ParserCollection();
    $collection->registerParser($parser);
    $node = $this->getNodeForHTML('<p>hello world</p>', 'p');

    $result = $collection->getParserForNode($node);

    $this->assertEquals($parser, $result);
  }

  function getNodeForHTML($html, $tag) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0);
  }

}