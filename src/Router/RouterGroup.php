<?php

namespace Ilias\PhpHttpRequestHandler\Router;

class RouterGroup
{
  public $prefix;
  public $middleware;
  public $routes = [];

  public function __construct($prefix = '', $middleware = [])
  {
    $this->prefix = $prefix;
    $this->middleware = $middleware;
  }

  public function addRoute($method, $uri, $action, $middleware = [])
  {
    $uri = $this->prefix . $uri;
    $middleware = array_merge($this->middleware, $middleware);
    $this->routes[] = new Route($method, $uri, $action, $middleware);
  }

  public function get($uri, $action, $middleware = [])
  {
    $this->addRoute('GET', $uri, $action, $middleware);
  }

  public function post($uri, $action, $middleware = [])
  {
    $this->addRoute('POST', $uri, $action, $middleware);
  }

  public function put($uri, $action, $middleware = [])
  {
    $this->addRoute('PUT', $uri, $action, $middleware);
  }

  public function delete($uri, $action, $middleware = [])
  {
    $this->addRoute('DELETE', $uri, $action, $middleware);
  }
}
