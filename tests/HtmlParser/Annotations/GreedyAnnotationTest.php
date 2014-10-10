<?php
require 'vendor/autoload.php';
use StructuredText\Annotation;
use StructuredText\HtmlParser\Annotations\GreedyAnnotationParser;

class GreedyAnnotationParserTest extends PHPUnit_Framework_TestCase {

  function testInit() {
    $parser = new GreedyAnnotationParser();
    $this->assertNotNull($parser);
  }

  function testMatchesAnything() {
    $parser = new GreedyAnnotationParser();
    $node1 = $this->getNode('b');
    $node2 = $this->getNode('i');
    $this->assertTrue($parser->canParseNode($node1));
    $this->assertTrue($parser->canParseNode($node2));
  }

  function testSetsCorrectType() {
    $parser = new GreedyAnnotationParser();
    $node = $this->getNode('b');
    $expected = new Annotation('*b', 0, 5);

    $actual = $parser->createAnnotationFromNode($node);

    $this->assertTrue($expected->isEqual($actual));
  }

  function getNode($tag) {
    $html = "<$tag>Hello</$tag>";
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0);
  }

}