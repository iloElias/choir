<?php

namespace Ilias\Choir\Controller;

use Ilias\Choir\Model\Asset;
use Ilias\Choir\Model\Greed;
use Ilias\Opherator\JsonResponse;
use Ilias\Opherator\Request\StatusCode;
use Ilias\Opherator\Response;

class IndexController
{
  public static function handleApiIndex()
  {
    $greedModel = new Greed();
    $response = new JsonResponse(new StatusCode(StatusCode::OK), [
      "message" => $greedModel->greed(),
    ]);
    return $response;
  }

  public static function favicon()
  {
    $assetLoader = new Asset();
    return $assetLoader->loadAsset("img", "favicon.ico");
  }
}
