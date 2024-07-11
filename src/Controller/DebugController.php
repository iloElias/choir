<?php

namespace Ilias\PhpHttpRequestHandler\Controller;

use Ilias\Opherator\Request\Request;
use Ilias\Opherator\Request\Response;
use Ilias\PhpHttpRequestHandler\Utilities\DirectoryReader;
use Ilias\Rhetoric\Router\Router;

class DebugController
{
  public static function showEnvironment()
  {
    Response::appendResponse("message", ["ping" => "pong"]);
    Response::appendResponse("data", ["request" => $GLOBALS]);
    Response::appendResponse("request", [
      "request_method" => Request::getMethod(),
      "params" => Router::getParams(),
      Request::hasBody() && "body" => Request::getBody(),
      "query" => Request::getQuery(),
    ]);
  }

  public static function showNestedParams()
  {
    Response::appendResponse("request", [
      "params" => Router::getParams(),
      "query" => Request::getQuery(),
    ]);
  }

  public static function getEnvironmentInstructions()
  {
    Response::appendResponse("message", [
      "instruction" => "There is none yet."
    ]);
  }

  public static function getEnvironmentVariable()
  {
    Response::appendResponse("data", [
      "requested_var" => Router::getParams()["variable"],
      // "variable_val" => Environments::$vars[Request::$params["variable"]]
    ]);
    Response::appendResponse("message", "This functionality will not return values.");
  }

  public static function mapProjectFiles()
  {
    $directoryReader = new DirectoryReader($_SERVER['DOCUMENT_ROOT']);
    Response::appendResponse("data", $directoryReader->readDirectory());
  }

  public static function showBody() {
    Response::appendResponse("data", Request::getBody());
  }
}
