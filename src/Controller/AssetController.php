<?php

namespace Ilias\PhpHttpRequestHandler\Controller;

use Ilias\PhpHttpRequestHandler\Bootstrap\Request;

class AssetController
{
  public static function instruction()
  {
    Request::$requestResponse = [
      "instructions" => [
        "introduction" => "Instructions on how do get assets",
        "step-by-step" => "There is a placeholder :p"
      ],
    ];
  }

  public static function getAssetByName()
  {
    DebugController::showEnvironment();

    // Request::$requestResponse = [
    //   "params" => Request::$requestParams
    // ];
  }

  public static function getAssetById()
  {
    Request::$requestResponse = [
      "params" => Request::$requestParams
    ];
  }
}