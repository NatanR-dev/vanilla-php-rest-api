<?php

namespace App\Http;

class NormalizeUrl
{
    public static function normalize(string $url): string
    {
        $url !== '/' && $url = rtrim($url, '/');

        return $url;
    }
}