<?php
namespace StructuredText\HtmlParser\Annotations;
use StructuredText\HtmlParser\Parser;

class BoldAnnotationParser { //implements AnnotationParser {

  public static function register(Parser $parser) {
    $parser->addAnnotationHandler(self::class);
  }

  public static function canParseNode(\DOMNode $node) {
    return $node->nodeName === 'b';
  }

  public static function createAnnotationFromNode(\DOMNode $dom, $offset = 0, $parser = null) {
    $type = '.b';
    $start = $offset + 0;
    $length = strlen($dom->textContent);

    return new \StructuredText\Annotation($type, $start, $length);
  }

}
