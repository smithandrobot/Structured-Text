<?php
namespace StructuredText\HtmlParser;
use StructuredText\Document;

class Parser {
  protected $blockHandlers;
  protected $annotationHandlers;

  public function __construct() {
    $this->blockHandlers = array();
    $this->annotationHandlers = array();
  }

  function addBlockHandler($handler) {
    $this->blockHandlers[] = $handler;
  }

  function getDomParserForElement($element) {
    foreach($this->blockHandlers as $handler) {
      if ($handler::canParseDomElement($element)) {
        return $handler;
      }
    }

    return false;
  }

  function addAnnotationHandler($handler) {
    $this->annotationHandlers[] = $handler;
  }

  function getAnnotationParserForElement($element) {
    foreach($this->annotationHandlers as $handler) {
      if ($handler::canParseNode($element)) {
        return $handler;
      }
    }

    return false;
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

          if ($block) {
            $document->addBlock($block);
          }
        }
      }
    }

    return $document;
  }

  function parseDomElement($element) {
    $handler = $this->getDomParserForElement($element);
    if ($handler) {
      return $handler::createBlockFromDom($element, $this);
    }
  }

  function findAnnotations(\DomNode $node) {
    $offset = 0;

    foreach ($node->childNodes as $child) {
      if ($handler = $this->getAnnotationParserForElement($child)) {
        print_r($handler);
      }
    }

    return array();
  }

  function domForContent($content) {
    $document = new \DOMDocument();
    $document->loadHTML($content);
    return $document;
  }
}
