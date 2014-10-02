<?php
require_once dirname(__FILE__) . '/../src/STHtmlParser.inc';

class STHtmlParseTests extends PHPUnit_Framework_TestCase {
  function testCanCreateAWrapper() {
    $parser = new STHtmlParser();
  }
}
