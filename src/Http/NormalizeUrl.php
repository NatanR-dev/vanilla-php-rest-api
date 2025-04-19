<?php

namespace App\Http;

use App\Http\RootUrl;

class NormalizeUrl
{
    use RootUrl;

    public static function normalize(string $url): string
    {
        $url !== self::ROOT_URL && $url = rtrim($url, '/');

        return $url;
    }
}