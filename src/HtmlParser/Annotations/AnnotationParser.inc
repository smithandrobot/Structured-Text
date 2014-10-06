<?php
namespace StructuredText\HtmlParser\Annotations;

interface AnnotationParser {

  public static function register();
  public static function canParseDOMNode(\DOMNode $dom);
  public static function createAnnotationFromNode(\DOMNode $dom, $parser);

}