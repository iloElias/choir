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
      
      Router::setup();

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