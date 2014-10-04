<?php
require 'vendor/autoload.php';
use StructuredText\Annotation;
use StructuredText\HtmlParser\Blocks\ParagraphBlockParser;

class BoldAnnotationParserTest extends PHPUnit_Framework_TestCase {

  function testInit() {
    $html = "<p>hello <b>world</b></p>";
    $node = $this->getNodeForHTML($html, 'p');

    $block = ParagraphBlockParser::createBlockFromDom($node);
    $annotations = $block->annotations();
    $annotation = new Annotation(".bold", 6, 5);

    $this->assertEqualAnnotations($annotation, $annotations[0]);
  }

  function getNodeForHTML($html, $tag) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0);
  }

  function assertEqualAnnotations($annotation1, $annotation2) {
    $this->assertInstanceOf('StructuredText\Annotation', $annotation1);
    $this->assertInstanceOf('StructuredText\Annotation', $annotation2);
    $this->assertEquals($annotation1->type(), $annotation2->type(), "Annotation type does not match");
    $this->assertEquals($annotation1->start(), $annotation2->start(), "Annotation start does not match");
    $this->assertEquals($annotation1->length(), $annotation2->length(), "Annotation length does not match");
    $this->assertEquals($annotation1->attributes(), $annotation2->attributes(), "Annotation attributes do not match");
  }
}