<?php

namespace Ilias\PhpHttpRequestHandler\Controller;

use Ilias\PhpHttpRequestHandler\Bootstrap\Request;

class AssetController
{
  public static function instruction()
  {
    Request::$response = [
      "instructions" => [
        "introduction" => "Instructions on how do get assets",
        "step-by-step" => "There is a placeholder :p"
      ],
    ];
  }

  public static function getAssetByName()
  {
    DebugController::showEnvironment();

    // Request::$response = [
    //   "params" => Request::$params
    // ];
  }

  public static function getAssetById()
  {
    Request::$response = [
      "params" => Request::$params
    ];
  }
}