<?php
require 'vendor/autoload.php';
use StructuredText\Annotation;
use StructuredText\HtmlParser\Annotations\BoldAnnotationParser;

class BoldAnnotationParserTest extends PHPUnit_Framework_TestCase {

  function testParsingAvailability() {
    $parser = new BoldAnnotationParser();
    $node = $this->getNode();


    $this->assertTrue($parser->canParseNode($node));
  }

  function testParsingBlankString() {
    $parser = new BoldAnnotationParser();
    $node = $this->getNode('<b></b>');
    $test = $parser->createAnnotationFromNode($node);
    $expected = new Annotation('.b', 0, 0);

    $this->assertTrue($expected->isEqual($test));
  }

  function testParsingString() {
    $parser = new BoldAnnotationParser();
    $node = $this->getNode();
    $test = $parser->createAnnotationFromNode($node);
    $expected = new Annotation('.b', 0, 11);

    $this->assertTrue($expected->isEqual($test));
  }

  function testParsingStringAtOffset() {
    $node = $this->getNode();
    $parser = new BoldAnnotationParser();
    $test = $parser->createAnnotationFromNode($node, 5);
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