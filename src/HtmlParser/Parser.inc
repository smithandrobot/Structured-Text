<?php
namespace StructuredText\HtmlParser;
use StructuredText\Document;

class Parser {
  protected $blockHandlers;
  protected $annotationFinder;

  public function __construct() {
    $this->blockHandlers = array();

    $this->annotationFinder = new AnnotationFinder();
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
    $this->annotationFinder->register($handler);
  }

  function getAnnotationParserForElement(\DOMNode $element) {
    return $this->annotationFinder->getHandler($element);
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
    return $this->annotationFinder->findAnnotations($node);
  }

  function domForContent($content) {
    $document = new \DOMDocument();
    $document->loadHTML($content);
    return $document;
  }
}
