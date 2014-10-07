<?php
require 'vendor/autoload.php';
use StructuredText\HtmlParser\HtmlAnnotationFinder;
use StructuredText\HtmlParser\Parser;
use StructuredText\HtmlParser\Blocks\ParagraphBlockParser;
use StructuredText\HtmlParser\Annotations\BoldAnnotationParser;
use StructuredText\HtmlParser\Annotations\TextAnnotationParser;

class AnnotationFinderTest extends PHPUnit_Framework_TestCase {

  function testInit() {
    $finder = new HtmlAnnotationFinder();
    $this->assertNotNull($finder);
  }

  function testRegistration() {
    $finder = new HtmlAnnotationFinder();
    $finder->register(BoldAnnotationParser::class);

    $this->assertCount(1, $finder->handlers());
  }

  function testFindingOne() {
    $node = $this->getNodeForHTML('<p><b>hello</b></p>', 'p');
    $finder = new HtmlAnnotationFinder();
    $finder->register(BoldAnnotationParser::class);
    $annotations = $finder->findAnnotations($node);

    $this->assertCount(1, $annotations);
    $this->assertEquals('.b', $annotations[0]->type());
  }

  function testFindingAtEnd() {
    $node = $this->getNodeForHTML('<p>hello <b>world</b></p>', 'p');
    $finder = new HtmlAnnotationFinder();
    $finder->register(BoldAnnotationParser::class);
    $finder->register(TextAnnotationParser::class);
    $annotations = $finder->findAnnotations($node);
    $expected = new \StructuredText\Annotation('.b', 6, 5);

    $this->assertCount(1, $annotations);
    $this->assertTrue($expected->isEqual($annotations[0]));
  }

  function getNodeForHTML($html, $tag) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0);
  }

}