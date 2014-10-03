<?php

class STHtmlParser {
  static protected $handlers = array();

  public static function addHandler($handler) {
    static::$handlers[] = $handler;
  }

  public function parse($content) {
    $document = new STDocument();

    if (strlen($content)) {
      $dom = $this->domForContent($content);
      $block = $this->parseDomElement($dom);
      $document->addBlock($block);
    }

    return $document;
  }

  function parseDomElement($element) {
    $handler = static::getDomParserForElement($element);
    if (!$handler) { throw new Exception("Cannot parse: " . $element); }

    return $handler::createBlockFromDom($element);
  }

  static function getDomParserForElement($element) {
    foreach(static::$handlers as $handler) {
      if ($handler::canParseDomElement($element)) {
        return $handler;
      }
    }

    return false;
  }

  function domForContent($content) {
    return new SimpleXMLElement($content);
  }
}