<?php
namespace StructuredText\HtmlParser\Blocks;

interface BlockParser {

  public function canParseDomElement(\DOMNode $dom);
  public function createBlockFromDom(\DOMNode $dom, $parser = null);

}
