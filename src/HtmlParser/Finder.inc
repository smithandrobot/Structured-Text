<?php
namespace StructuredText\HtmlParser;

interface Finder {
  public function findMatches(\DOMNode $node, ParserCollection $collection);
}