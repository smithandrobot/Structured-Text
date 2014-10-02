<?php
require_once dirname(__FILE__) . '/../src/STHtmlParagraphBlockParser.inc';

class STHtmlParagraphBlockParserTest extends PHPUnit_Framework_TestCase {

  function testSimpleParagraph() {
    $dom = new SimpleXMLElement("<p>Hello</p>");
    $result = STHtmlParagraphBlockParser::createBlockFromDom($dom);
    $block = new STBlock(".paragraph", "Hello");

    $this->assertEqualBlocks($block, $result);
  }

  function assertEqualBlocks($block1, $block2) {
    $this->assertEquals($block1->type(), $block2->type(), "Block types do not match");
    $this->assertEquals($block1->text(), $block2->text(), "Block text does not match");
    $this->assertEquals($block1->attributes(), $block2->attributes(), "Block attributes do not match");
    $this->assertEquals($block1->annotations(), $block2->annotations(), "Block annotations do not match");
    $this->assertEquals($block1->children(), $block2->children(), "Block children do not match");
  }

}