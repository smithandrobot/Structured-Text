<?php

interface STHtmlBlockParser {

  public static function canParseDomElement(DOMNode $dom);
  public static function createBlockFromDom(DOMNode $dom);

}