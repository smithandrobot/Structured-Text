<?php
require 'vendor/autoload.php';
use StructuredText\Block;
use StructuredText\HtmlParser\Parser;

class HtmlParserTest extends PHPUnit_Framework_TestCase {

  function testCanCreateAParser() {
    $parser = new Parser();
    $this->assertNotNull($parser);
  }

  function testParsesABlankString() {
    $parser = new Parser();
    $result = $parser->parse("");

    $this->assertNotNull($result);
  }

  function testParsesParagraph() {
    $parser = new Parser();
    $document = $parser->parse("<p>Hello World</p>");
    $block = new Block(".paragraph", "Hello World");

    $this->assertEqualBlocks($block, $document->blocks[0]);
  }


  function assertEqualBlocks($block1, $block2) {
    $this->assertInstanceOf('StructuredText\Block', $block1);
    $this->assertInstanceOf('StructuredText\Block', $block2);

    $this->assertEquals($block1->type(), $block2->type(), "Block types do not match");
    $this->assertEquals($block1->text(), $block2->text(), "Block text does not match");
    $this->assertEquals($block1->attributes(), $block2->attributes(), "Block attributes do not match");
    $this->assertEquals($block1->annotations(), $block2->annotations(), "Block annotations do not match");
    $this->assertEquals($block1->children(), $block2->children(), "Block children do not match");
  }

}
