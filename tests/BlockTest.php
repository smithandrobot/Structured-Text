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

  function testSameBlockIsEqual() {
    $block = new Block();
    $this->assertTrue($block->isEqual($block));
  }

  function testBlocksWithDifferentTypesAreNotEqual() {
    $block1 = new Block("foo");
    $block2 = new Block("bar");

    $this->assertFalse($block1->isEqual($block2));
  }

  function testBlocksWithDifferentTextAreNotEqual() {
    $block1 = new Block("foo", "text1");
    $block2 = new Block("foo", "text2");

    $this->assertFalse($block1->isEqual($block2));
  }

  function testBlocksWithDifferentAttributesAreNotEqual() {
    $block1 = new Block("foo", "text", array());
    $block2 = new Block("foo", "text", array(1));

    $this->assertFalse($block1->isEqual($block2));
  }

  function testBlocksWithDifferentAnnotationsAreNotEqual() {
    $block1 = new Block("foo", "text", array(), array());
    $block2 = new Block("foo", "text", array(), array(1));

    $this->assertFalse($block1->isEqual($block2));
  }

  function testBlocksWithDifferentChildrenAreNotEqual() {
    $block1 = new Block("foo", "text", array(), array(), array());
    $block2 = new Block("foo", "text", array(), array(), array(1));

    $this->assertFalse($block1->isEqual($block2));
  }

}