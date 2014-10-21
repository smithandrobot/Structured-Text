<?php
namespace StructuredText\HtmlParser;

use StructuredText\HtmlParser\Annotations;
use StructuredText\HtmlParser\Blocks;

class ParserCollection {

  protected $parsers;

  public function __construct() {
    $this->parsers = array();
  }

  public function registerParser($parser) {
    $this->parsers[] = $parser;
  }

  public function parsers() {
    return $this->parsers;
  }

  // TODO: who should win?
  public function getParserForNode(\DOMNode $node) {
    foreach ($this->parsers as $parser) {
      if ($parser->canParseDomNode($node)) {
        return $parser;
      }
    }

    return false;
  }


  public static function configuredBlockParserCollection() {
    $collection = new ParserCollection();
    $collection->registerParser(new Blocks\ContainerBlockParser());
    $collection->registerParser(new Blocks\HeaderBlockParser());
    $collection->registerParser(new Blocks\ParagraphBlockParser());

    return $collection;
  }

  public static function configuredAnnotationParserCollection() {
    $collection = new ParserCollection();
    $collection->registerParser(new Annotations\BoldAnnotationParser());
    $collection->registerParser(new Annotations\LinkAnnotationParser());

    return $collection;
  }
}
