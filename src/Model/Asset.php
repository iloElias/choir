<?php

namespace Ilias\PhpHttpRequestHandler\Model;

use Ilias\PhpHttpRequestHandler\Bootstrap\Request;

class Asset
{
  public string $assetFolderPath;

  public function __construct() {
    $this->assetFolderPath = __DIR__ . "/../Assets";
  }

  public function loadAsset(string $assetType, string|int $assetIdentifier)
  {
    $assetType = ucfirst($assetType);
    $this->assetFolderPath .= "/{$assetType}/{$assetIdentifier}";
    if (file_exists($this->assetFolderPath)) {
      header('Content-Type: image/x-icon');
      readfile($this->assetFolderPath);
      return;
    }

    http_response_code(404);
    Request::$requestResponse["message"] = "Asset {$assetIdentifier} type {$assetType} was not found";
  }
}