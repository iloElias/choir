<?php

namespace Ilias\PhpHttpRequestHandler\Controller;

use Ilias\PhpHttpRequestHandler\Bootstrap\Request;
use Ilias\PhpHttpRequestHandler\Model\Greed;

class IndexController
{
  public static function handleApiIndex()
  {
    $greedModel = new Greed();
    Request::$requestResponse["message"] = $greedModel->greed();
  }

  public static function favicon()
  {
    $filePath = __DIR__ . '/../Assets/Images/favicon.ico';

    if (file_exists($filePath)) {
      header('Content-Type: image/x-icon');

      readfile($filePath);
    } else {
      http_response_code(404);
      echo '404 Not Found';
    }

    exit;
  }
}
