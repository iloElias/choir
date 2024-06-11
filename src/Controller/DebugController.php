<?php

namespace Ilias\PhpHttpRequestHandler\Controller;

use Ilias\PhpHttpRequestHandler\Bootstrap\Request;
use Ilias\PhpHttpRequestHandler\Router\Router;

class DebugController
{
  public static function showEnvironment()
  {
    Request::$requestResponse["message"] = ["ping" => "pong"];
    Request::$requestResponse["data"] = [];
    Request::$requestResponse["request"]["request_method"] = Request::$requestMethod;
    Request::$requestResponse["request"]["params"] = Request::$requestParams;
    Request::$requestResponse["request"]["query"] = Request::$requestQuery;
    Request::$requestResponse["data"]["request"] = $GLOBALS;
  }
}
