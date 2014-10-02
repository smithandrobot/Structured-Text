<?php

interface STHtmlBlockParser {

  public static function canParseDomElement($dom);

  public static function createBlockFromDom($dom);

}