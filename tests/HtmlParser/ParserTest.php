<?php
require 'vendor/autoload.php';
use StructuredText\Block;
use StructuredText\HtmlParser\Parser;
use StructuredText\HtmlParser\Blocks\ParagraphBlockParser;
use StructuredText\HtmlParser\Annotations\BoldAnnotationParser;

class ParserTest extends PHPUnit_Framework_TestCase {

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
    $parser->addBlockHandler(ParagraphBlockParser::class);
    $document = $parser->parse("<p>Hello World</p>");
    $block = new Block(".paragraph", "Hello World");

    $this->assertCount(1, $document->blocks);
    $this->assertInstanceOf('StructuredText\Block', $document->blocks[0]);
    $this->assertTrue($block->isEqual($document->blocks[0]));
  }

  function testSimpleFile() {
    $html = file_get_contents(dirname(__FILE__) . '/../resources/simple.html');

    $parser = new Parser();
    $parser->addBlockHandler(ParagraphBlockParser::class);
    $document = $parser->parse($html);

    $this->assertEquals('com.structured_text.core', $document->scope);
    $this->assertCount(1, $document->blocks);
  }

}
