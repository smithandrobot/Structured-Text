<?php
require 'vendor/autoload.php';
use StructuredText\Annotation;
use StructuredText\HtmlParser\Parser;
use StructuredText\HtmlParser\Blocks\ParagraphBlockParser;
use StructuredText\HtmlParser\Annotations\BoldAnnotationParser;

class BoldAnnotationParserTest extends PHPUnit_Framework_TestCase {

//  function xtestInit() {
//    $html = "<p>hello <b>world</b></p>";
//    $node = $this->getNodeForHTML($html, 'p');
//    $parser = new Parser();
//
//    $annotations = $parser->findAnnotations($node);
//    $annotation = new Annotation(".bold", 6, 5);
//
//    $this->assertCount(1, $annotations);
//    $this->assertTrue($annotation->isEqual($annotations[0]));
//  }

  function testActivates() {
    $parser = new Parser();
    $parser->addAnnotationHandler(BoldAnnotationParser::class);

    $html = "<p>hello <b>world</b></p>";
    $node = $this->getNodeForHTML($html, 'b');


    $handlerClass = $parser->getAnnotationParserForElement($node);
    $handler = new $handlerClass;
    $this->assertInstanceOf('StructuredText\HtmlParser\Annotations\BoldAnnotationParser', $handler);
  }

  function getNodeForHTML($html, $tag) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0);
  }
}