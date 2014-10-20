<?php
namespace StructuredText\HtmlParser;
use StructuredText\Document;

class Parser {
  protected $annotationFinder;
  protected $annotationParsers;
  protected $blockFinder;
  protected $blockParsers;

  public static function configuredParser() {
    $annotationCollection = ParserCollection::configuredAnnotationParserCollection();
    $blockCollection = ParserCollection::configuredBlockParserCollection();

    return new Parser($annotationCollection, $blockCollection);
  }

  public function __construct($annotationCollection = null, $blockCollection = null) {
    $this->annotationParsers = $annotationCollection? $annotationCollection : new ParserCollection();
    $this->annotationFinder = new AnnotationFinder($this->annotationParsers);
    $this->blockParsers = $blockCollection? $blockCollection : new ParserCollection();
    $this->blockFinder = new BlockFinder($this->blockParsers);
  }

  function addAnnotationHandler($handler) {
    $this->annotationParsers->registerParser($handler);
  }

  function annotationParser() {
    return $this->annotationParsers;
  }

  function addBlockHandler($handler) {
    $this->blockParsers->registerParser($handler);
  }

  function blockParsers() {
    return $this->blockParsers;
  }

  public function parse($content) {
    $document = new Document();

    if (strlen($content)) {
      $dom = $this->domForContent($content);
      $xpath = new \DOMXPath($dom);
      $bodies = $xpath->query('//body');

      foreach($bodies as $body) {
        foreach ($body->childNodes as $child) {
          $block = $this->blockFinder->findMatches($child);

          if ($block) {
            $document->addBlock($block);
          }
        }
      }
    }

    return $document;
  }

  function parseDomElement($element) {
    $handler = $this->blockParsers()->getParserForNode($element);
    if ($handler) {
      return $handler->createBlockFromDom($element, $this);
    }
  }

  function findAnnotations(\DomNode $node) {
    return $this->annotationFinder->findMatches($node);
  }

  function domForContent($content) {
    $document = new \DOMDocument();
    $document->loadHTML($content);
    return $document;
  }
}
