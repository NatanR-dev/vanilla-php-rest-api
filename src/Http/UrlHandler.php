<?php

namespace App\Http;

use App\Http\RootUrl;

class UrlHandler
{
    use RootUrl;

    public static function getUrl(string $baseUrl = self::ROOT_URL): string
    {
        if (isset($_GET['url'])) {
            $baseUrl .= $_GET['url'];
        }
        
        return $baseUrl;
    }
}