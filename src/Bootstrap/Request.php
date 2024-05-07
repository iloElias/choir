<?php

namespace Ilias\PhpHttpRequestHandler\Bootstrap;
use Ilias\PhpHttpRequestHandler\Bootstrap\Handler;

class Request
{
    public static function AddHeader(string $name, string $content, bool $replace = true) {
        try {
            header("{$name}: {$content}", $replace);
        } catch (\Throwable $th) {
            http_response_code(500);
            Handler::HandleException($th);
        }
    }
    public static function header()
    {
        // TODO
    }

    public static function Answer()
    {
        echo json_encode(Handler::$requestResponse);
    }

    public static function JsonResponse()
    {
        header("Content-Type: application/json; charset=UTF-8", true);
    }
}