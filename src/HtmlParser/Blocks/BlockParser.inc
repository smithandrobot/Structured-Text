<?php
namespace StructuredText\HtmlParser\Blocks;

interface BlockParser {

  public static function canParseDomElement(\DOMNode $dom);
  public static function createBlockFromDom(\DOMNode $dom, $parser);

}