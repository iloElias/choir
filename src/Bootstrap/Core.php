<?php

namespace Ilias\Choir\Bootstrap;

use Ilias\Dotenv\Environment;
use Ilias\Dotenv\Exceptions\EnvironmentNotFound;
use Ilias\Opherator\Exceptions\InvalidResponseException;
use Ilias\Opherator\JsonResponse;
use Ilias\Opherator\Opherator;
use Ilias\Opherator\Request;
use Ilias\Opherator\Response;
use Ilias\Opherator\Request\StatusCode;
use Ilias\Rhetoric\Exceptions\MiddlewareException;
use Ilias\Rhetoric\Exceptions\RouteNotFoundException;
use Ilias\Rhetoric\Router\Router;

class Core
{
  public static function handle(array $params = [])
  {
    /* Request handling example */
    try {
      Environment::setup(null, Environment::SUPPRESS_EXCEPTION);
      Request::setup();

      Opherator::toggleResponseExceptions();
      Response::jsonResponse();
      Response::setResponse(Router::handle() ?? []);

      Response::answer();
    } catch (EnvironmentNotFound $environmentNotFoundEx) {
      self::handleEnvironmentException($environmentNotFoundEx);
    } catch (RouteNotFoundException $notFoundEx) {
      self::handleRouteException($notFoundEx);
    } catch (MiddlewareException $midEx) {
      self::handleMiddlewareException($midEx);
    } catch (\Throwable $th) {
      self::handleException($th);
    }
  }

  public static function handleEnvironmentException(EnvironmentNotFound $environmentNotFoundEx): void
  {
    $response = new JsonResponse(new StatusCode(StatusCode::NOT_FOUND), [
      'message' => empty($environmentNotFoundEx->getMessage()) ? 'No environment file found' : $environmentNotFoundEx->getMessage()
    ]);
    Response::setResponse($response);
    Response::answer();
  }

  public static function handleRouteException(RouteNotFoundException $notFoundEx): void
  {
    $response = new JsonResponse(new StatusCode(StatusCode::NOT_FOUND), [
      'message' => empty($notFoundEx->getMessage()) ? 'Route not found' : $notFoundEx->getMessage()
    ]);
    Response::setResponse($response);
    Response::answer();
  }

  public static function handleMiddlewareException(MiddlewareException $midEx): void
  {
    $response = new JsonResponse(new StatusCode(StatusCode::UNAUTHORIZED), [
      'message' => empty($midEx->getMessage()) ? 'Route middleware terms not met' : $midEx->getMessage()
    ]);
    Response::setResponse($response);
    Response::answer();
  }

  public static function handleException(\Throwable $th): void
  {
    $response = new JsonResponse(new StatusCode(StatusCode::INTERNAL_SERVER_ERROR), [
      'message' => empty($th->getMessage()) ? 'No error message provided' : $th->getMessage(),
      'exception' => $th
    ]);
    Response::setResponse($response);
    Response::answer();
  }
}
