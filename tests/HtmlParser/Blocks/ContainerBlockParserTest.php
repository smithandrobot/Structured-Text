<?php
use StructuredText\Block;
use StructuredText\HtmlParser\Blocks\ContainerBlockParser;

class ContainerBlockParserTest extends PHPUnit_Framework_TestCase {

  function testInit() {
    $parser = new ContainerBlockParser();
    $this->assertNotNull($parser);
  }

  function testCanParseDiv() {
    $node = $this->getNodeForHTML('<div>hello</div>', 'div');
    $parser = new ContainerBlockParser();

    $this->assertTrue($parser->canParseDomElement($node));
  }

  function testCannotParseHeaders() {
    $node = $this->getNodeForHTML('<h1>Hasd</h1>', 'h1');
    $parser = new ContainerBlockParser();

    $this->assertFalse($parser->canParseDomElement($node));
  }

  function testCanParseDivCorrectly() {
    $node = $this->getNodeForHTML('<div>hello</div>', 'div');
    $parser = new ContainerBlockParser();
    $expected = new Block('.container', 'hello');
    $actual = $parser->createBlockFromDom($node);

    $this->assertTrue($expected->isEqual($actual));
  }


  function getNodeForHTML($html, $tag) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0);
  }
}