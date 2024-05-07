<?php

namespace Ilias\PhpHttpRequestHandler\Bootstrap;

class Handler
{
    public static function Handle (array $params = [])
    {
        /* Request handling example */
        Request::JsonResponse();
        Request::$requestResponse["message"] = ["ping" => "pong"];

        Request::Answer();
    }

    public static function HandleException(\Throwable $th)
    {
        Request::$requestResponseStatus = "Internal exception";
        Request::$requestResponse["message"] = $th->getMessage();
        Request::$requestResponse["exception"] = $th;

        Request::Answer();
    }
}