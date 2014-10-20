<?php
namespace StructuredText\HtmlParser;

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
      if ($parser->canParseDomElement($node)) {
        return $parser;
      }
    }

    return false;
  }
}
