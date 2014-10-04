<?php
require 'vendor/autoload.php';
use StructuredText\Annotation;


class AnnotationTest extends PHPUnit_Framework_TestCase {

  function testAnnotationCreation() {
    $annotation = new Annotation("foo", 1, 50);
    $this->assertNotNull($annotation);
  }

  function testBlankAnnotationShouldHaveNoAttributes() {
    $annotation = new Annotation("foo", 1, 10);
    $this->assertCount(0, $annotation->attributes());
  }

}