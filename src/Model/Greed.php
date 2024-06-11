<?php

namespace Ilias\PhpHttpRequestHandler\Model;

use Ilias\PhpHttpRequestHandler\Bootstrap\Request;

class Greed
{
  public function greed()
  {
    if (isset(Request::$requestQuery["uwu"])) {
      return "Good programming senpai!";
    }
    return "Good programming!";
  }
}