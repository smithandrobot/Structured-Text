<?php
require 'vendor/autoload.php';
use StructuredText\Block;
use StructuredText\Document;

class DocumentTest extends PHPUnit_Framework_TestCase {

  function testCanCreateDocument() {
    $document = new Document();
    $this->assertNotNull($document);
  }

  function testHasDefaultScope() {
    $document = new Document();
    $this->assertEquals($document->scope, "com.structured_text.core");
  }

  function testBlankDocumentHasNoBlocks() {
    $document = new Document();
    $this->assertCount(0, $document->blocks);
  }

  function testCanAddABlock() {
    $document = new Document();
    $block = new Block();

    $document->addBlock($block);
    $this->assertCount(1, $document->blocks);
  }


}