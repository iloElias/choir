<?php

namespace Ilias\PhpHttpRequestHandler\Bootstrap;

class Handler
{
    public static array $requestResponse;

    public static function Handle (array $params = [])
    {
        /* Request handling example */
        Request::JsonResponse();
        self::$requestResponse["response"] = ["ping" => "pong"];

        Request::Answer();
    }

    public static function HandleException(\Throwable $th)
    {
        self::$requestResponse["status"] = "Internal exception";
        self::$requestResponse["exception_message"] = $th->getMessage();
        self::$requestResponse["detailed_exception"] = $th;

        Request::Answer();
    }
}