<?php

namespace Ilias\PhpHttpRequestHandler\Router;

use Ilias\PhpHttpRequestHandler\Controller\AssetController;
use Ilias\PhpHttpRequestHandler\Controller\DebugController;
use Ilias\PhpHttpRequestHandler\Controller\IndexController;
use Ilias\PhpHttpRequestHandler\Router\Router;

class Routes
{
  public static function setup()
  {
    Router::setup();

    Router::get("/", [IndexController::class, "handleApiIndex"]);
    Router::get("/favicon.ico", [IndexController::class, "favicon"]);
    
    Router::get("/asset", [AssetController::class, "instruction"]);
    Router::get("/asset/{name}/name", [AssetController::class, "getImageByName"]);
    Router::get("/asset/{id}/id", [AssetController::class, "getImageById"]);

    Router::get("/debug", [DebugController::class, "showEnvironment"]);
  }
}
