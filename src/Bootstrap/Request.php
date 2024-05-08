<?php

namespace Ilias\PhpHttpRequestHandler\Bootstrap;

use Ilias\PhpHttpRequestHandler\Bootstrap\Handler;

class Request
{
  public static $requestResponseStatus;
  public static $requestResponse;
  public static $requestMethod;
  public static $requestQuery;

  public static function setRequestInfo()
  {
    self::$requestMethod = $_SERVER["REQUEST_METHOD"] ?? "";
    self::$requestQuery = $_GET ?? "";
  }

  public static function answer()
  {
    self::$requestResponseStatus["code"] = http_response_code();
    echo json_encode(["status" => self::$requestResponseStatus, ...self::$requestResponse]);
  }

  public static function jsonResponse()
  {
    header("Content-Type: application/json; charset=UTF-8", true);
  }
}
