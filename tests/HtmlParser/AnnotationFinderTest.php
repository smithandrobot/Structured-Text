<?php
require 'vendor/autoload.php';
use StructuredText\Annotation;
use StructuredText\HtmlParser\AnnotationFinder;
use StructuredText\HtmlParser\ParserCollection;
use StructuredText\HtmlParser\Annotations\BoldAnnotationParser;
use StructuredText\HtmlParser\Annotations\GreedyAnnotationParser;

class AnnotationFinderTest extends PHPUnit_Framework_TestCase {

  function testInit() {
    $finder = new AnnotationFinder();
    $this->assertNotNull($finder);
  }

  function testFindingOne() {
    $node = $this->getNodeForHTML('<p><b>hello</b></p>', 'p');
    $collectionMock = $this->getMock(ParserCollection::class);
    $collectionMock->method('getParserForNode')
      ->will($this->returnValue(new BoldAnnotationParser()));
    $annotion = new Annotation('.b', 0, 5);

    $finder = new AnnotationFinder();
    $annotations = $finder->findMatches($node, $collectionMock);

    $this->assertCount(1, $annotations);
    $this->assertTrue($annotion->isEqual($annotations[0]));
  }

  function testFindingAtEnd() {
    $node = $this->getNodeForHTML('<p>hello <b>world</b></p>', 'p');
    $collectionMock = $this->getMock(ParserCollection::class);
    $collectionMock->method('getParserForNode')
      ->will($this->returnValue(new BoldAnnotationParser()));

    $finder = new AnnotationFinder();
    $annotations = $finder->findMatches($node, $collectionMock);
    $expected = new Annotation('.b', 6, 5);

    $this->assertCount(1, $annotations);
    $this->assertTrue($expected->isEqual($annotations[0]));
  }

  function testFindingMultiple() {
    $node = $this->getNodeForHTML('<p><b>Hello</b> <b>World</b></p>', 'p');
    $collectionMock = $this->getMock(ParserCollection::class);
    $collectionMock->method('getParserForNode')
      ->will($this->returnValue(new BoldAnnotationParser()));

    $finder = new AnnotationFinder();
    $annotations = $finder->findMatches($node, $collectionMock);

    $this->assertCount(2, $annotations);
  }

  function testFindingNestedAnnotations() {
    $node = $this->getNodeForHTML('<p><b>hello <i>world</i></b></p>', 'p');
    $collectionMock = $this->getMock(ParserCollection::class);
    $collectionMock->method('getParserForNode')
      ->will($this->returnValue(new GreedyAnnotationParser()));

    $annotation1 = new Annotation('*b', 0, 11);
    $annotation2 = new Annotation('*i', 6, 5);

    $finder = new AnnotationFinder();
    $annotations = $finder->findMatches($node, $collectionMock);

    $this->assertCount(2, $annotations);
    $this->assertTrue($annotation1->isEqual($annotations[0]));
    $this->assertTrue($annotation2->isEqual($annotations[1]));
  }

  function getNodeForHTML($html, $tag) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0);
  }

}