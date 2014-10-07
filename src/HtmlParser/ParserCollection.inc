<?php
namespace StructuredText\HtmlParser;

class ParserCollection {

  protected $parsers;
  protected $finder;

  public function __construct(Finder $finder = null) {
    $this->parsers = array();
    $this->finder = $finder;
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

  public function findMatches(\DOMNode $node) {
    $this->finder->findMatches($node, $this);
  }
}
