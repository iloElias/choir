<?php

namespace Ilias\PhpHttpRequestHandler\Controller;

use Ilias\PhpHttpRequestHandler\Bootstrap\Request;
use Ilias\PhpHttpRequestHandler\Model\Asset;
use Ilias\PhpHttpRequestHandler\Model\Greed;
use Ilias\PhpHttpRequestHandler\Router\Router;

class IndexController
{
  public static function handleApiIndex()
  {
    $greedModel = new Greed();
    Request::$response["message"] = $greedModel->greed();
  }

  public static function favicon()
  {
    $assetLoader = new Asset();
    $assetLoader->loadAsset("img", "favicon.ico");
  }
}
