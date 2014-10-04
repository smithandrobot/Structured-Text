<?php
require 'vendor/autoload.php';
use StructuredText\Block;

class BlockTest extends PHPUnit_Framework_TestCase {

  function testCanInit() {
    $block = new Block();
    $this->assertNotNull($block);
  }

  function testStoresType() {
    $block = new Block("foobar");
    $this->assertEquals("foobar", $block->type());
  }

  function testBlockDoesntHaveAttributes() {
    $block = new Block();
    $this->assertCount(0, $block->attributes());
  }

  function testBlockDoesntHaveAnnotations() {
    $block = new Block();
    $this->assertCount(0, $block->annotations());
  }

  function testBlockDoesntHaveChildren() {
    $block = new Block();
    $this->assertCount(0, $block->children());
  }

}