<?php
namespace StructuredText\JsonRender;

use StructuredText\Document;

class JsonRenderer {

  public static function render(Document $document) {
    echo json_encode($document);
  }

}