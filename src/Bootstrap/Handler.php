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
      Request::setup();
      
      Router::setup();

      Request::answer();
    } catch (\Throwable $th) {
      http_response_code(500);
      self::handleException($th);
    }
  }

  public static function handleException(\Throwable $th)
  {
    Request::$requestResponse["message"] = $th->getMessage();
    Request::$requestResponse["exception"] = get_object_vars($th);

    Request::answer();
  }
}