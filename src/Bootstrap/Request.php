<?php

namespace Ilias\PhpHttpRequestHandler\Bootstrap;
use Ilias\PhpHttpRequestHandler\Bootstrap\Handler;

class Request
{
    public static array $requestResponse;
    public static string $requestResponseStatus;

    public static function AddHeader(string $name, string $content, bool $replace = true) {
        try {
            header("{$name}: {$content}", $replace);
        } catch (\Throwable $th) {
            http_response_code(500);
            Handler::HandleException($th);
        }
    }
    public static function Header()
    {
        // TODO
    }

    public static function Answer()
    {
        self::$requestResponseStatus["code"] = http_response_code();
        echo json_encode(["status" => self::$requestResponseStatus, ...self::$requestResponse]);
    }

    public static function JsonResponse()
    {
        header("Content-Type: application/json; charset=UTF-8", true);
    }
}