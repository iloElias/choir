<?php

namespace Ilias\PhpHttpRequestHandler\Bootstrap;
class Request
{
  public static array $response = [];
  public static array $params = [];
  public static array $query;
  private static bool $hasBody = false;
  private static array $body;
  public static string $responseStatus;
  public static string $method;

  public static function setup()
  {
    self::$method = $_SERVER["REQUEST_METHOD"] ?? "";
    self::$query = $_GET ?? "";
    self::handleBody();
  }

  public static function getParams(): array
  {
    return self::$params;
  }

  public static function getBody(): array
  {
    return self::$body;
  }

  public static function getQuery(): array
  {
    return self::$query;
  }

  public static function setResponse(array $response)
  {
    self::$response = $response;
  }

  public static function appendResponse(string $key = "data", string|array $response, bool $override = true)
  {
    if ($override) {
      self::$response[$key] = $response;
      return;
    }
    self::$response[$key][] = $response;
  }

  public static function answer()
  {
    self::$responseStatus = http_response_code();
    echo json_encode(["status" => ["code" => self::$responseStatus], ...self::$response]);
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
      self::$body = json_decode(file_get_contents("php://input"), true);
    }
  }
}
