<?php

use Ilias\PhpHttpRequestHandler\Controller\AssetController;
use Ilias\PhpHttpRequestHandler\Controller\DebugController;
use Ilias\PhpHttpRequestHandler\Controller\IndexController;
use Ilias\PhpHttpRequestHandler\Router\Router;

Router::get("/", IndexController::class . "@handleApiIndex");
Router::get("/favicon.ico", IndexController::class . "@favicon");

Router::group("/asset", function ($router) {
  $router->get("/", AssetController::class . "@instruction");
  $router->group("/{type}", function ($router) {
    $router->get("/name/{name}", AssetController::class . "@getAssetByName");
    $router->get("/id/{id}", AssetController::class . "@getAssetById");
  });
});

Router::group("/debug", function ($router) {
  $router->get("/", DebugController::class . "@showEnvironment");
  $router->group("/env", function ($router) {
    $router->get("/", DebugController::class . "@getEnvironmentInstructions");
    $router->get("/{variable}", DebugController::class . "@getEnvironmentVariable");
  });
  $router->get("/dir", DebugController::class . "@mapProjectFiles");
  $router->get("/{first}/{second}/{third}", DebugController::class . "@showNestedParams");
});

Router::post("/debug/body", DebugController::class . "@showBody");