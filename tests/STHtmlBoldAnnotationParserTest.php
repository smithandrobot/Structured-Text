<?php
require_once dirname(__FILE__) . '/../src/STHtmlParagraphBlockParser.inc';
require_once dirname(__FILE__) . '/../src/STAnnotation.inc';

class STHtmlBoldAnnotationParserTest extends PHPUnit_Framework_TestCase {

  function testInit() {
    $html = "<p>hello <b>world</b></p>";
    $node = $this->getNodeForHTML($html, 'p');

    $block = STHtmlParagraphBlockParser::createBlockFromDom($node);
    $annotations = $block->annotations();
    $annotation = new STAnnotation(".bold", 6, 5);

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
    $this->assertInstanceOf('STAnnotation', $annotation1);
    $this->assertInstanceOf('STAnnotation', $annotation2);
    $this->assertEquals($annotation1->type(), $annotation2->type(), "Annotation type does not match");
    $this->assertEquals($annotation1->start(), $annotation2->start(), "Annotation start does not match");
    $this->assertEquals($annotation1->length(), $annotation2->length(), "Annotation length does not match");
    $this->assertEquals($annotation1->attributes(), $annotation2->attributes(), "Annotation attributes do not match");
  }
}