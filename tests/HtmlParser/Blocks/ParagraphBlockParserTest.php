<?php
require 'vendor/autoload.php';
use StructuredText\Block;
use StructuredText\HtmlParser\Parser;
use StructuredText\HtmlParser\Blocks\ParagraphBlockParser;

class ParagraphBlockParserTest extends PHPUnit_Framework_TestCase {

  function testSimpleParagraph() {
    $node = $this->getNodeForHTML('<p>Hello</p>', 'p');
    $parser = new Parser();
    $result = ParagraphBlockParser::createBlockFromDom($node, $parser);
    $block = new Block(".paragraph", "Hello");

    $this->assertEqualBlocks($block, $result);
  }

  function getNodeForHTML($html, $tag) {
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $nodes = $xpath->query('//'. $tag);

    return $nodes->item(0);
  }

  function assertEqualBlocks($block1, $block2) {
    $this->assertEquals($block1->type(), $block2->type(), "Block types do not match");
    $this->assertEquals($block1->text(), $block2->text(), "Block text does not match");
    $this->assertEquals($block1->attributes(), $block2->attributes(), "Block attributes do not match");
    $this->assertEquals($block1->annotations(), $block2->annotations(), "Block annotations do not match");
    $this->assertEquals($block1->children(), $block2->children(), "Block children do not match");
  }

}