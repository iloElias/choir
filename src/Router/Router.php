<?php

namespace Ilias\PhpHttpRequestHandler\Router;

use Ilias\PhpHttpRequestHandler\Bootstrap\Request;
use Ilias\PhpHttpRequestHandler\Middleware\Middleware;

class Router
{
  private static $routes = [];
  private static $routeGroups = [];
  private static $baseMiddleware = [];

  public static function setup()
  {
    $uri = explode("?", $_SERVER["REQUEST_URI"])[0];
    $method = $_SERVER["REQUEST_METHOD"];
    self::dispatch($method, ($uri !== "/" && str_ends_with($uri, "/")) ? substr($uri, 0, -1) : $uri);
  }

  public static function addRoute(Route $route)
  {
    self::$routes[] = $route;
  }

  public static function get(string $uri, string $action, array $middleware = [])
  {
    self::addRoute(
      new Route('GET', $uri, $action, $middleware)
    );
  }

  public static function post(string $uri, string $action, array $middleware = [])
  {
    self::addRoute(
      new Route('POST', $uri, $action, $middleware)
    );
  }

  public static function put(string $uri, string $action, array $middleware = [])
  {
    self::addRoute(
      new Route('PUT', $uri, $action, $middleware)
    );
  }

  public static function delete(string $uri, string $action, array $middleware = [])
  {
    self::addRoute(
      new Route('DELETE', $uri, $action, $middleware)
    );
  }

  public static function group(array $attributes, callable $callback)
  {
    $prefix = $attributes['prefix'] ?? '';
    $middleware = $attributes['middleware'] ?? [];
    $group = new RouterGroup($prefix, array_merge(self::$baseMiddleware, $middleware));
    self::$routeGroups[] = $group;

    call_user_func($callback, $group);
  }

  public static function dispatch($method, $uri)
  {
    foreach (self::$routes as $route) {
      if (self::matchRoute($route, $method, $uri)) {
        self::handleRoute($route);
        return;
      }
    }

    foreach (self::$routeGroups as $group) {
      foreach ($group->routes as $route) {
        if (self::matchRoute($route, $method, $uri)) {
          self::handleRoute($route);
          return;
        }
      }
    }

    http_response_code(404);
    Request::appendResponse("message", "Route not found");
  }

  private static function matchRoute($route, $method, $uri)
  {
    if ($route->method !== $method) {
      return false;
    }

    $pattern = preg_replace('/\{([\w]+)\}/', '([\w-]+)', $route->uri);
    $pattern = str_replace('/', '\/', $pattern);
    $pattern = '/^' . $pattern . '$/';

    if (preg_match($pattern, $uri, $matches)) {
      $params = [];
      preg_match_all('/\{([\w]+)\}/', $route->uri, $paramNames);
      foreach ($paramNames[1] as $index => $name) {
        $params[$name] = $matches[$index + 1];
      }
      Request::$requestParams = $params;
      return true;
    }

    return false;
  }

  private static function handleRoute($route)
  {
    foreach ($route->middleware as $middleware) {
      if (is_subclass_of($middleware, Middleware::class)) {
        $middleware::handle();
      }
    }

    [$controller, $method] = explode('@', $route->action);
    $controllerInstance = new $controller;
    call_user_func([$controllerInstance, $method]);
  }
}
