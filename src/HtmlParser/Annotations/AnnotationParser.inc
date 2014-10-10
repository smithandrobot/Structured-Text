<?php
namespace StructuredText\HtmlParser\Annotations;

interface AnnotationParser {

  // public function register(Parser $parser);
  public function canParseNode(\DOMNode $dom);
  public function createAnnotationFromNode(\DOMNode $dom, $offset = 0, $parser = null);

}