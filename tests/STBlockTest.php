<?php
require_once dirname(__FILE__) . '/../src/STHtmlParagraphBlockParser.inc';

class STBlockTest extends PHPUnit_Framework_TestCase {

  function testCanInit() {
    $block = new STBlock();
    $this->assertNotNull($block);
  }

  function testStoresType() {
    $block = new STBlock("foobar");
    $this->assertEquals("foobar", $block->type());
  }

  function testBlockDoesntHaveAttributes() {
    $block = new STBlock();
    $this->assertCount(0, $block->attributes());
  }

  function testBlockDoesntHaveAnnotations() {
    $block = new STBlock();
    $this->assertCount(0, $block->annotations());
  }

  function testBlockDoesntHaveChildren() {
    $block = new STBlock();
    $this->assertCount(0, $block->children());
  }

}