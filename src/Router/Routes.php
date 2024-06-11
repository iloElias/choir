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
    Router::get("/", IndexController::class . "@handleApiIndex");
    Router::get("/favicon.ico", IndexController::class . "@favicon");
    
    Router::get("/asset", AssetController::class . "@instruction");
    Router::group([
      'prefix' => '/asset/type/{type}'
    ], function ($router) {
      $router->get("/name/{name}", AssetController::class . "@getImageByName");
      $router->get("/id/{id}", AssetController::class . "@getImageById");
    });

    Router::get("/debug", DebugController::class . "@showEnvironment");
  }
}
