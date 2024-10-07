<?php

namespace Ilias\Choir\Controller;

use Ilias\Opherator\Request;
use Ilias\Opherator\Request\StatusCode;
use Ilias\Opherator\Response;
use Ilias\Choir\Utilities\DirectoryReader;
use Ilias\Choir\Utilities\FileReader;
use Ilias\Opherator\JsonResponse;
use Ilias\Rhetoric\Router\Router;

class DebugController
{
  public static function showEnvironment()
  {
    $jsonResponse = new JsonResponse(new StatusCode(StatusCode::OK), [
      'message' => 'Those are the environment variables',
      'data' => ["request" => $GLOBALS],
      "request" => [
        "request_method" => Request::getMethod(),
        "params" => Router::getParams(),
        Request::hasBody() && "body" => Request::getBody(),
        "query" => Request::getQuery(),
      ]
    ]);
    Response::setResponse((array) $jsonResponse);
  }

  public static function showNestedParams()
  {
    $response = new JsonResponse(new StatusCode(StatusCode::OK), [
      "request" => [
        "params" => Router::getParams(),
        "query" => Request::getQuery(),
      ]
    ]);
    return $response;
  }

  public static function getEnvironmentInstructions()
  {
    $response = new JsonResponse(new StatusCode(StatusCode::OK), [
      "message" => [
        "instruction" => "There is none yet."
      ]
    ]);
    return $response;
  }

  public static function getEnvironmentVariable()
  {
    $response = new JsonResponse(new StatusCode(StatusCode::OK), [
      "message" => "This functionality will not return values."
      // "variable_val" => Environments::$vars[Request::$params["variable"]]
    ]);
    return $response;
  }

  public static function mapProjectFiles()
  {
    $directoryReader = new DirectoryReader($_SERVER['DOCUMENT_ROOT']);
    $response = new JsonResponse(new StatusCode(StatusCode::OK), [
      "data" => $directoryReader->readDirectory()
    ]);
    return $response;
  }

  public static function getFileContent()
  {
    $filePath = Request::getQuery()["path"];
    $directoryReader = new FileReader($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $filePath);
    $response = new JsonResponse(new StatusCode(StatusCode::OK), [
      "data" => $directoryReader->readFile()
    ]);
    return $response;
  }

  public static function showBody()
  {
    $response = new JsonResponse(new StatusCode(StatusCode::OK), [
      "data" => Request::getBody()
    ]);
    return $response;
  }
}
