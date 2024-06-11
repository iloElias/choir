<?php

namespace Ilias\PhpHttpRequestHandler\Router;

use Ilias\PhpHttpRequestHandler\Bootstrap\Request;
use Ilias\PhpHttpRequestHandler\Exceptions\DuplicatedRouteException;
use Ilias\PhpHttpRequestHandler\Middleware\Middleware;
use Throwable;

class Router
{
  public static $routes = [];
  public static $params = [];
  public static $uri = "";

  public static function setup()
  {
    self::$uri = explode("?", $_SERVER["REQUEST_URI"] ?? '')[0];
  }

  public static function handle()
  {
    $method = strtolower($_SERVER['REQUEST_METHOD']);
    foreach (self::$routes[$method] ?? [] as $route => $config) {
      if (self::matchRoute($route)) {
        self::executeRouteProcedure($method, $route);
        return;
      }
    }

    http_response_code(404);
    Request::$requestResponse = ['error' => 'Route not found'];
  }

  private static function matchRoute($routePattern)
  {
    $regex = str_replace('/', '\/', preg_replace('/\{([\w]+)\}/', '(?P<$1>[\w-]+)', $routePattern));
    $regex = "/^" . $regex . "$/";

    if (preg_match($regex, self::$uri, $matches)) {
      foreach ($matches as $key => $value) {
        if (is_string($key)) {
          self::$params[$key] = $value;
        }
      }
      return true;
    }
    return false;
  }

  private static function setRoute(string $method, string $route, array $instruction, array $middleware = null)
  {
    if (!str_starts_with($route, '/')) {
      $route = '/' . $route;
    }

    $route = strtolower($route);

    if (isset(self::$routes[$method][$route])) {
      throw new DuplicatedRouteException("Duplicated routes cannot be set");
    }

    self::$routes[$method][$route] = [$instruction, $middleware];
  }

  public static function get(string $route, array $instruction, array $middleware = null)
  {
    self::setRoute('get', $route, $instruction, $middleware);
  }

  public static function post(string $route, array $instruction, array $middleware = null)
  {
    self::setRoute('post', $route, $instruction, $middleware);
  }

  public static function put(string $route, array $instruction, array $middleware = null)
  {
    self::setRoute('put', $route, $instruction, $middleware);
  }

  public static function delete(string $route, array $instruction, array $middleware = null)
  {
    self::setRoute('delete', $route, $instruction, $middleware);
  }

  private static function executeMiddlewares(array $middlewareList)
  {
    foreach ($middlewareList as $middleware) {
      if (is_subclass_of($middleware, Middleware::class)) {
        $middleware::handle();
      }
    }
  }

  private static function executeRouteProcedure(string $method, string $route)
  {
    [[$className, $classMethod], $middleware] = self::$routes[strtolower($method)][$route];

    if (!$className || !$classMethod) {
      http_response_code(404);
      throw new \Exception(sprintf('API route not found: %s on %s', $method, $route));
    }

    if (!empty($middleware)) {
      try {
        self::executeMiddlewares($middleware);
      } catch (Throwable $e) {
        http_response_code(401);
        throw new \Exception("This request does not pass by middleware terms: " . $e->getMessage(), $e->getCode(), $e);
      }
    }

    try {
      call_user_func([$className, $classMethod]);
    } catch (Throwable $throwable) {
      http_response_code(500);
      throw new \Exception($throwable->getMessage() . " " . $throwable->getFile() . " " . $throwable->getLine() . " Trace" . $throwable->getTraceAsString(), $throwable->getCode(), $throwable);
    }
  }
}
