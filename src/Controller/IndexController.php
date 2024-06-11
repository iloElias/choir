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
    Request::$requestResponse["message"] = $greedModel->greed();
  }

  public static function favicon()
  {
    $assetType = Request::getParams()[""];
    $assetIdentifier = Request::getParams()[""];

    $assetLoader = new Asset();
    $assetLoader->loadAsset($assetType, $assetIdentifier);
  }
}
