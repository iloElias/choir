<?php

namespace Ilias\PhpHttpRequestHandler\Bootstrap;
class Request
{
  public static array $requestResponse = [];
  public static array $requestParams = [];
  public static array $requestQuery;
  public static string $requestResponseStatus;
  public static string $requestMethod;

  public static function setRequestInfo()
  {
    self::$requestMethod = $_SERVER["REQUEST_METHOD"] ?? "";
    self::$requestQuery = $_GET ?? "";
  }

  public static function getParams(): array
  {
    return self::$requestParams;
  }

  public static function getQuery(): array
  {
    return self::$requestQuery;
  }

  public static function setResponse(array $response)
  {
    self::$requestResponse = $response;
  }

  public static function appendResponse(string $key = "data", string|array $response, bool $override = true)
  {
    if ($override) {
      self::$requestResponse[$key] = $response;
      return;
    }
    self::$requestResponse[$key][] = $response;
  }

  public static function answer()
  {
    self::$requestResponseStatus = http_response_code();
    echo json_encode(["status" => ["code" => self::$requestResponseStatus], ...self::$requestResponse]);
  }

  public static function jsonResponse()
  {
    header("Content-Type: application/json; charset=UTF-8", true);
  }
}
