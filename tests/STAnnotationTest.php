<?php
require_once dirname(__FILE__) . '/../src/STAnnotation.inc';

class STAnnotationTest extends PHPUnit_Framework_TestCase {

  function testAnnotationCreation() {
    $annotation = new STAnnotation("foo", 1, 50);
    $this->assertNotNull($annotation);
  }

  function testBlankAnnotationShouldHaveNoAttributes() {
    $annotation = new STAnnotation("foo", 1, 10);
    $this->assertCount(0, $annotation->attributes());
  }

}