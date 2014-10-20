<?php

require_once dirname(__FILE__) .'/../vendor/autoload.php';
use StructuredText\HtmlParser\Parser;

$html = file_get_contents(dirname(__FILE__) . '/../tests/resources/complicated.html');

$parser = Parser::configuredParser();
$document = $parser->parse($html);

print_r($document);