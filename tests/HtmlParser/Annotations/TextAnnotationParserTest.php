<?php
require 'vendor/autoload.php';
use StructuredText\HtmlParser\Annotations\TextAnnotationParser;

class TextAnnotationParserTest extends PHPUnit_Framework_TestCase {

  function testParsingAbility() {
    $node = $this->getNode();
    $this->assertTrue(TextAnnotationParser::canParseNode($node));
  }

  function testAnnotationIsParsed() {
    $node = $this->getNode();
    $parser = new TextAnnotationParser();
    $annotation = $parser->createAnnotationFromNode($node);

    $this->assertInstanceOf('StructuredText\Annotation', $annotation);
  }

  function testAnnotationIsNotPersisted() {
    $parser = new TextAnnotationParser();
    $this->assertFalse($parser->shouldPersist());
  }

  function getNode($html = 'Hello World', $tag = 'p') {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0)->firstChild;
  }
}