<?php

namespace Ilias\PhpHttpRequestHandler\Controller;

use Ilias\PhpHttpRequestHandler\Bootstrap\Request;
use Ilias\PhpHttpRequestHandler\Router\Router;

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
      "params" => Router::$params
    ];
  }

  public static function getImageById()
  {
    Request::$requestResponse = [
      "params" => Router::$params
    ];
  }
}