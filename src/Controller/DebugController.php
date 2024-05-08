<?php

namespace Ilias\PhpHttpRequestHandler\Controller;

use Ilias\PhpHttpRequestHandler\Bootstrap\Request;

class DebugController
{
  public static function showEnvironment()
  {
    Request::$requestResponse["php"]["globals"] = $GLOBALS;
  }
}
