<?php

namespace Ilias\PhpHttpRequestHandler\Controller;

use Ilias\Opherator\Request\Response;
use Ilias\PhpHttpRequestHandler\Model\Asset;
use Ilias\PhpHttpRequestHandler\Model\Greed;

class IndexController
{
  public static function handleApiIndex()
  {
    $greedModel = new Greed();
    Response::appendResponse("message", $greedModel->greed());
  }

  public static function favicon()
  {
    $assetLoader = new Asset();
    $assetLoader->loadAsset("img", "favicon.ico");
  }
}
