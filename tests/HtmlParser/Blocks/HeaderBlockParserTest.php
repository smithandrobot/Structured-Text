<?php
require 'vendor/autoload.php';
use StructuredText\HtmlParser\Blocks\HeaderBlockParser;

class HeaderBlockParserTest extends PHPUnit_Framework_TestCase {

  function testInit() {
    $parser = new HeaderBlockParser();
    $this->assertNotNull($parser);
  }

  function testAllowsParsingHeaders() {
    for ($i = 1; $i <= 6; $i++) {
      $node = $this->getNodeForHTML("<h$i>Header</h$i>", "h$i");
      $this->assertTrue(HeaderBlockParser::canParseDomElement($node), "Cannot parse h$i");
    }
  }

  function testDoesNotAllowParsingP() {
    $node = $this->getNodeForHTML('<p>Header</p>', 'p');
    $this->assertFalse(HeaderBlockParser::canParseDomElement($node));
  }

  function testCreatesBlockFromValidNode() {
    $node = $this->getNodeForHTML('<h1>Hello</h1>', 'h1');
    $block = HeaderBlockParser::createBlockFromDom($node);

    $this->assertInstanceOf('StructuredText\Block', $block);
  }

  function testDoesNotCreateBlockFromInvalidNode() {
    $node = $this->getNodeForHTML('<p>Hello</p>', 'p');
    $block = HeaderBlockParser::createBlockFromDom($node);

    $this->assertFalse($block);
  }

  function testBlockHasCorrectType() {
    $node = $this->getNodeForHTML('<h1>Hello</h1>', 'h1');
    $block = HeaderBlockParser::createBlockFromDom($node);

    $this->assertEquals('.header', $block->type());
  }

  function testBlockHasCorrectText() {
    $node = $this->getNodeForHTML('<h1>Hello</h1>', 'h1');
    $block = HeaderBlockParser::createBlockFromDom($node);

    $this->assertEquals('Hello', $block->text());
  }

  function testHasCorrectDepth() {
    $depth = 3;
    $node = $this->getNodeForHTML("<h$depth>Hello</h$depth>", "h$depth");
    $block = HeaderBlockParser::createBlockFromDom($node);

    $this->assertEquals($depth, $block->attributes()->depth, 'Header depth does not match');
  }

  function getNodeForHTML($html, $tag) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0);
  }
}