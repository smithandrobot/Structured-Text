<?php
namespace StructuredText\HtmlParser;
use StructuredText\Document;

class Parser {
  static protected $handlers = array();

  public static function addHandler($handler) {
    static::$handlers[] = $handler;
  }

  public function parse($content) {
    $document = new Document();

    if (strlen($content)) {
      $dom = $this->domForContent($content);
      $xpath = new \DOMXPath($dom);
      $bodies = $xpath->query('//body');

      foreach($bodies as $body) {
        foreach ($body->childNodes as $child) {
          $block = $this->parseDomElement($child);
          $document->addBlock($block);
        }
      }


    }

    return $document;
  }

  function parseDomElement($element) {
    $handler = static::getDomParserForElement($element);
    if (!$handler) { throw new Exception("Cannot parse: " . $element->textContent); }

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
    $document = new \DOMDocument();
    $document->loadHTML($content);
    return $document;
  }
}
