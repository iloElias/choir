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
    $this->assetFolderPath .= "/{$assetType}/{$assetIdentifier}";
    if (file_exists($this->assetFolderPath)) {
      readfile($this->assetFolderPath);
      return;
    }

    http_response_code(404);
    Request::$requestResponse["message"] = "Asset {$assetIdentifier} type {$assetType} was not found";
  }
}