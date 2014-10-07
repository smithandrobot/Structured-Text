<?php
require 'vendor/autoload.php';
use StructuredText\HtmlParser\Blocks\HeaderBlockParser;

class HeaderBlockParserTest extends PHPUnit_Framework_TestCase {

  function testInit() {
    $parser = new HeaderBlockParser();
    $this->assertNotNull($parser);
  }

  function testAllowsParsingH1s() {
    $node = $this->getNodeForHTML('<h1>Header</h1>', 'h1');
    $this->assertTrue(HeaderBlockParser::canParseDomElement($node));
  }

  function testAllowsParsingH2s() {
    $node = $this->getNodeForHTML('<h2>Header</h2>', 'h2');
    $this->assertTrue(HeaderBlockParser::canParseDomElement($node));
  }

  function testDoesNotAllowParsingP() {
    $node = $this->getNodeForHTML('<p>Header</p>', 'p');
    $this->assertFalse(HeaderBlockParser::canParseDomElement($node));
  }

  function getNodeForHTML($html, $tag) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0);
  }
}