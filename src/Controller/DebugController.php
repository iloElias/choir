<?php

namespace Ilias\PhpHttpRequestHandler\Controller;

use Ilias\PhpHttpRequestHandler\Bootstrap\Request;
use Ilias\PhpHttpRequestHandler\Utilities\DirectoryReader;
use Ilias\PhpHttpRequestHandler\Utilities\FileReader;

class DebugController
{
  public static function showEnvironment()
  {
    Request::$response["message"] = ["ping" => "pong"];
    Request::$response["data"] = [];
    Request::$response["request"]["request_method"] = Request::$method;
    Request::$response["request"]["params"] = Request::$params;
    Request::hasBody() && Request::$response["request"]["body"] = Request::getBody();
    Request::$response["request"]["query"] = Request::$query;
    Request::$response["data"]["request"] = $GLOBALS;
  }

  public static function showNestedParams()
  {
    Request::$response["request"]["params"] = Request::$params;
    Request::$response["request"]["query"] = Request::$query;
  }

  public static function getEnvironmentInstructions()
  {
    Request::$response["message"] = [
      "instruction" => "There is none yet."
    ];
  }

  public static function getEnvironmentVariable()
  {
    Request::$response["data"] = [
      "requested_var" => Request::$params["variable"],
      // "variable_val" => Environments::$vars[Request::$params["variable"]]
    ];
    Request::$response["message"] = "This functionality will not return values.";
  }

  public static function mapProjectFiles()
  {
    $directoryReader = new DirectoryReader($_SERVER['DOCUMENT_ROOT']);
    Request::$response["data"] = $directoryReader->readDirectory();
  }

  public static function showBody() {
    Request::$response["data"] = Request::getBody();
  }
}
