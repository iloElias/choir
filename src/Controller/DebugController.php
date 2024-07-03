<?php

namespace Ilias\PhpHttpRequestHandler\Controller;

use Ilias\PhpHttpRequestHandler\Bootstrap\Request;
use Ilias\PhpHttpRequestHandler\Utilities\DirectoryReader;
use Ilias\PhpHttpRequestHandler\Utilities\FileReader;

class DebugController
{
  public static function showEnvironment()
  {
    Request::$requestResponse["message"] = ["ping" => "pong"];
    Request::$requestResponse["data"] = [];
    Request::$requestResponse["request"]["request_method"] = Request::$requestMethod;
    Request::$requestResponse["request"]["params"] = Request::$requestParams;
    Request::hasBody() && Request::$requestResponse["request"]["body"] = Request::getBody();
    Request::$requestResponse["request"]["query"] = Request::$requestQuery;
    Request::$requestResponse["data"]["request"] = $GLOBALS;
  }

  public static function showNestedParams()
  {
    Request::$requestResponse["request"]["params"] = Request::$requestParams;
    Request::$requestResponse["request"]["query"] = Request::$requestQuery;
  }

  public static function getEnvironmentInstructions()
  {
    Request::$requestResponse["message"] = [
      "instruction" => "There is none yet."
    ];
  }

  public static function getEnvironmentVariable()
  {
    Request::$requestResponse["data"] = [
      "requested_var" => Request::$requestParams["variable"],
      // "variable_val" => Environments::$vars[Request::$requestParams["variable"]]
    ];
    Request::$requestResponse["message"] = "This functionality will not return values.";
  }

  public static function mapProjectFiles()
  {
    $directoryReader = new DirectoryReader($_SERVER['DOCUMENT_ROOT']);
    Request::$requestResponse["data"] = $directoryReader->readDirectory();
  }
}
