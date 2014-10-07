<?php
require 'vendor/autoload.php';
use StructuredText\Annotation;
use StructuredText\HtmlParser\Parser;
use StructuredText\HtmlParser\Blocks\ParagraphBlockParser;
use StructuredText\HtmlParser\Annotations\BoldAnnotationParser;

class BoldAnnotationParserTest extends PHPUnit_Framework_TestCase {

  function testParsingAvailability() {
    $node = $this->getNode();

    $this->assertTrue(BoldAnnotationParser::canParseNode($node));
  }

  function testParserRegistration() {
    $parser = new Parser();
    $parser->addAnnotationHandler(BoldAnnotationParser::class);
    $node = $this->getNode();

    $handlerClass = $parser->getAnnotationParserForElement($node);
    $handler = new $handlerClass;
    $this->assertInstanceOf('StructuredText\HtmlParser\Annotations\BoldAnnotationParser', $handler);
  }

  function testParsingBlankString() {
    $node = $this->getNode('<b></b>');
    $test = BoldAnnotationParser::createAnnotationFromNode($node);
    $expected = new Annotation('.b', 0, 0);

    $this->assertTrue($expected->isEqual($test));
  }

  function testParsingString() {
    $node = $this->getNode();
    $test = BoldAnnotationParser::createAnnotationFromNode($node);
    $expected = new Annotation('.b', 0, 11);

    $this->assertTrue($expected->isEqual($test));
  }

  function testParsingStringAtOffset() {
    $node = $this->getNode();
    $test = BoldAnnotationParser::createAnnotationFromNode($node, 5);
    $expected = new Annotation('.b', 5, 11);

    $this->assertTrue($expected->isEqual($test));
  }



  function getNode($html = '<b>Hello World</b>', $tag = 'b') {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0);
  }
}