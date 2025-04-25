<?php


namespace App\Utils;

class MysqlErrorResolver
{
    public static function isNoPermission(int $code): bool
    {
        return $code === 1044;
    }

    public static function isDatabaseNotFound(int $code): bool
    {
        return $code === 1049;
    }

    public static function isDuplicateEntry(int $code): bool
    {
        return $code === 1062;
    }

    public static function isInvalidCredentials(int $code): bool
    {
        return $code === 1045;
    }

    public static function isKnown(int $code): bool
    {
        return in_array($code, [1044, 1049, 1062, 1045]);
    }
}
