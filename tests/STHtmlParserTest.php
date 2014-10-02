<?php
require_once dirname(__FILE__) . '/../src/STHtmlParser.inc';
//require_once dirname(__FILE__) . '/../src/STHtmlParagraphBlockParser.inc';

class STHtmlParserTest extends PHPUnit_Framework_TestCase {

  function testCanCreateAParser() {
    $parser = new STHtmlParser();
    $this->assertNotNull($parser);
  }

  function testParsesABlankString() {
    $parser = new STHtmlParser();
    $result = $parser->parse("");

    $this->assertNotNull($result);
  }

  function testParsesParagraph() {
    $parser = new STHtmlParser();
    $document = $parser->parse("<p>Hello World</p>");
    $block = new STBlock(".paragraph", "Hello World");

    $this->assertEqualBlocks($block, $document->blocks[0]);
  }


  function assertEqualBlocks($block1, $block2) {
    $this->assertInstanceOf('STBlock', $block1);
    $this->assertInstanceOf('STBlock', $block2);

    $this->assertEquals($block1->type(), $block2->type(), "Block types do not match");
    $this->assertEquals($block1->text(), $block2->text(), "Block text does not match");
    $this->assertEquals($block1->attributes(), $block2->attributes(), "Block attributes do not match");
    $this->assertEquals($block1->annotations(), $block2->annotations(), "Block annotations do not match");
    $this->assertEquals($block1->children(), $block2->children(), "Block children do not match");
  }

}
