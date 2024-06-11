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

  public static function getImageByName()
  {
    Request::$requestResponse = [
      "params" => Request::$requestParams
    ];
  }

  public static function getImageById()
  {
    Request::$requestResponse = [
      "params" => Request::$requestParams
    ];
  }
}