<?php

namespace Ilias\PhpHttpRequestHandler\Bootstrap;
class Request
{
  public static array $requestResponse = [];
  public static array $requestParams = [];
  public static array $requestQuery;
  private static bool $hasBody = false;
  private static array $requestBody;
  public static string $requestResponseStatus;
  public static string $requestMethod;

  public static function setup()
  {
    self::$requestMethod = $_SERVER["REQUEST_METHOD"] ?? "";
    self::$requestQuery = $_GET ?? "";
    self::handleBody();
  }

  public static function getParams(): array
  {
    return self::$requestParams;
  }

  public static function getBody(): array
  {
    return self::$requestBody;
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
  
  public static function htmlResponse()
  {
    header("Content-Type: text/html; charset=UTF-8", true);
  }

  public static function hasBody() : bool
  {
    return self::$hasBody;
  }

  private static function handleBody()
  {
    if (file_get_contents("php://input")) {
      self::$hasBody = true;
      self::$requestBody = json_decode(file_get_contents("php://input"), true);
    }
  }
}
