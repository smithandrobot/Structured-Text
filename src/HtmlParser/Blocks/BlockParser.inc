<?php
namespace StructuredText\HtmlParser\Blocks;

interface BlockParser {

  public function canParseDomNode(\DOMNode $dom);
  public function createBlockFromDom(\DOMNode $dom, $parser = null);

}
