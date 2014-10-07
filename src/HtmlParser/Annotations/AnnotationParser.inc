<?php
namespace StructuredText\HtmlParser\Annotations;

interface AnnotationParser {

  // public static function register(Parser $parser);
  public static function canParseNode(\DOMNode $dom);
  public static function createAnnotationFromNode(\DOMNode $dom, $offset = 0, $parser = null);
  public static function shouldPersist();

}