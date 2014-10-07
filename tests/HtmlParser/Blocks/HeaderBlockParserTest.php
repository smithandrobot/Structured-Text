<?php
require 'vendor/autoload.php';
use StructuredText\HtmlParser\Blocks\HeaderBlockParser;

class HeaderBlockParserTest extends PHPUnit_Framework_TestCase {

  function testInit() {
    $parser = new HeaderBlockParser();
    $this->assertNotNull($parser);
  }

  function testAllowsParsingHeaders() {
    $parser = new HeaderBlockParser();

    for ($i = 1; $i <= 6; $i++) {
      $node = $this->getNodeForHTML("<h$i>Header</h$i>", "h$i");
      $this->assertTrue($parser->canParseDomElement($node), "Cannot parse h$i");
    }
  }

  function testDoesNotAllowParsingP() {
    $parser = new HeaderBlockParser();
    $node = $this->getNodeForHTML('<p>Header</p>', 'p');

    $this->assertFalse($parser->canParseDomElement($node));
  }

  function testCreatesBlockFromValidNode() {
    $parser = new HeaderBlockParser();
    $node = $this->getNodeForHTML('<h1>Hello</h1>', 'h1');
    $block = $parser->createBlockFromDom($node);

    $this->assertInstanceOf('StructuredText\Block', $block);
  }

  function testDoesNotCreateBlockFromInvalidNode() {
    $parser = new HeaderBlockParser();
    $node = $this->getNodeForHTML('<p>Hello</p>', 'p');
    $block = $parser->createBlockFromDom($node);

    $this->assertFalse($block);
  }

  function testBlockHasCorrectType() {
    $parser = new HeaderBlockParser();
    $node = $this->getNodeForHTML('<h1>Hello</h1>', 'h1');
    $block = $parser->createBlockFromDom($node);

    $this->assertEquals('.header', $block->type());
  }

  function testBlockHasCorrectText() {
    $parser = new HeaderBlockParser();
    $node = $this->getNodeForHTML('<h1>Hello</h1>', 'h1');
    $block = $parser->createBlockFromDom($node);

    $this->assertEquals('Hello', $block->text());
  }

  function testHasCorrectDepth() {
    $parser = new HeaderBlockParser();
    $depth = 3;
    $node = $this->getNodeForHTML("<h$depth>Hello</h$depth>", "h$depth");
    $block = $parser->createBlockFromDom($node);

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