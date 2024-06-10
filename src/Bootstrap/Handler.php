<?php

namespace Ilias\PhpHttpRequestHandler\Bootstrap;

use Ilias\PhpHttpRequestHandler\Router\Router;
use Ilias\PhpHttpRequestHandler\Router\Routes;

class Handler
{
  public static $environment = [];

  public static function handle(array $params = [])
  {
    /* Request handling example */
    try {
      Routes::setup();
      Request::jsonResponse();
      Request::setRequestInfo();
      Request::$requestResponse["message"] = ["ping" => "pong"];
      Request::$requestResponse["data"] = [];
      Request::$requestResponse["request"]["request_method"] = Request::$requestMethod;
      Request::$requestResponse["request"]["uri"] = Router::$uri;
      Request::$requestResponse["request"]["params"] = Router::$params;
      Request::$requestResponse["request"]["query"] = Request::$requestQuery;
      Request::$requestResponse["data"]["request"] = $GLOBALS;

      // Request::$requestResponse = Router::handle();

      Request::answer();
    } catch (\Throwable $th) {
      self::handleException($th);
    }
  }

  public static function handleException(\Throwable $th)
  {
    Request::$requestResponseStatus = "Internal exception";
    Request::$requestResponse["message"] = $th->getMessage();
    Request::$requestResponse["exception"] = $th;

    Request::answer();
  }
}