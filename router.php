<?php

use Ilias\PhpHttpRequestHandler\Controller\AssetController;
use Ilias\PhpHttpRequestHandler\Controller\DebugController;
use Ilias\PhpHttpRequestHandler\Controller\IndexController;
use Ilias\PhpHttpRequestHandler\Router\Router;

Router::get("/", IndexController::class . "@handleApiIndex");
Router::get("/favicon.ico", IndexController::class . "@favicon");

Router::get("/asset", AssetController::class . "@instruction");
Router::group(['prefix' => '/asset/{type}'], function ($router) {
  $router->get("/name/{name}", AssetController::class . "@getAssetByName");
  $router->get("/id/{id}", AssetController::class . "@getAssetById");
  
  $router->group(['prefix' => '/details/{test}'], function ($router) {
    $router->get("/extra/{extra}", DebugController::class . "@showEnvironment");
  });
});

Router::get("/debug/{alpha}/{beta}/{delta}", DebugController::class . "@showNestedParams");
Router::get("/debug", DebugController::class . "@showEnvironment");

