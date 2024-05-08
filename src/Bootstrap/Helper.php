<?php

namespace Ilias\PhpHttpRequestHandler\Bootstrap;

class Helper
{
    public static function env($key, $default = '')
    {
        return getenv($key) ?? $default;
    }
}
