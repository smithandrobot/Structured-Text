<?php
require_once dirname(__FILE__) . '/../src/STDocument.inc';
require_once dirname(__FILE__) . '/../src/STBlock.inc';

class STDocumentTest extends PHPUnit_Framework_TestCase {

  function testCanCreateDocument() {
    $document = new STDocument();
    $this->assertNotNull($document);
  }

  function testHasDefaultScope() {
    $document = new STDocument();
    $this->assertEquals($document->scope, "com.structured_text.core");
  }

  function testBlankDocumentHasNoBlocks() {
    $document = new STDocument();
    $this->assertCount(0, $document->blocks);
  }

  function testCanAddABlock() {
    $document = new STDocument();
    $block = new STBlock();

    $document->addBlock($block);
    $this->assertCount(1, $document->blocks);
  }


}