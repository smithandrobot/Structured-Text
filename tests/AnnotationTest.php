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

  function testAnnotationIsEqualToSelf() {
    $annotation = new Annotation("foo", 1, 50);

    $this->assertTrue($annotation->isEqual($annotation));
  }

  function testAnnotationWithDifferentTypesAreNotEqual() {
    $annotation1 = new Annotation("foo", 1, 50);
    $annotation2 = new Annotation("bar", 1, 50);

    $this->assertFalse($annotation1->isEqual($annotation2));
  }

  function testAnnotationWithDifferentStartsAreNotEqual() {
    $annotation1 = new Annotation("foo", 1, 50);
    $annotation2 = new Annotation("foo", 10, 50);

    $this->assertFalse($annotation1->isEqual($annotation2));
  }

  function testAnnotationWithDifferentLengthsAreNotEqual() {
    $annotation1 = new Annotation("foo", 1, 40);
    $annotation2 = new Annotation("foo", 1, 50);

    $this->assertFalse($annotation1->isEqual($annotation2));
  }

  function testAnnotationWithDifferentAttributesAreNotEqual() {
    $annotation1 = new Annotation("foo", 1, 50);
    $annotation2 = new Annotation("foo", 1, 50, array('foo' => 'bar'));

    $this->assertFalse($annotation1->isEqual($annotation2));
  }

  function testAnnotationWithSamePropertiesShouldBeEqual() {
    $annotation1 = new Annotation("foo", 1, 40);
    $annotation2 = new Annotation("foo", 1, 40);

    $this->assertTrue($annotation1->isEqual($annotation2));
  }

}