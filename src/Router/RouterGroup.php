<?php

namespace Ilias\PhpHttpRequestHandler\Router;

class RouterGroup
{
  private $prefix;
  private $middleware;
  private $routes = [];

  public function __construct(string $prefix, array $middleware = [])
  {
    $this->prefix = rtrim($prefix, '/');
    $this->middleware = $middleware;
  }

  public function getRoutes()
  {
    return $this->routes;
  }

  public function addRoute(Route $route)
  {
    $route->uri = $this->prefix . '/' . ltrim($route->uri, '/');
    $route->middleware = array_merge($this->middleware, $route->middleware);
    $this->routes[] = $route;
  }

  public function get(string $uri, string $action, array $middleware = [])
  {
    $this->addRoute(
      new Route('GET', $uri, $action, $middleware)
    );
  }

  public function post(string $uri, string $action, array $middleware = [])
  {
    $this->addRoute(
      new Route('POST', $uri, $action, $middleware)
    );
  }

  public function put(string $uri, string $action, array $middleware = [])
  {
    $this->addRoute(
      new Route('PUT', $uri, $action, $middleware)
    );
  }

  public function delete(string $uri, string $action, array $middleware = [])
  {
    $this->addRoute(
      new Route('DELETE', $uri, $action, $middleware)
    );
  }

  public function group(array $attributes, callable $callback)
  {
    $prefix = $attributes['prefix'] ?? '';
    $middleware = $attributes['middleware'] ?? [];
    $group = new RouterGroup($this->prefix . '/' . trim($prefix, '/'), array_merge($this->middleware, $middleware));

    call_user_func($callback, $group);

    foreach ($group->getRoutes() as $route) {
      $this->routes[] = $route;
    }
  }
}
