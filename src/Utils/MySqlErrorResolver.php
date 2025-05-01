<?php


namespace App\Utils;

class MySqlErrorResolver
{
    public static function isNoPermission(int $code): bool
    {
        return $code === 1044;
    }

    public static function isInvalidCredentials(int $code): bool
    {
        return $code === 1045;
    }

    public static function isDatabaseNotFound(int $code): bool
    {
        return $code === 1049;
    }

    public static function isFieldNotFound(int $code): bool
    {
        return $code === 1054;
    }

    public static function isDuplicateEntry(int $code): bool
    {
        return $code === 1062;
    }

    public static function isTableNotFound(int $code): bool
    {
        return $code === 1146;
    }

    public static function isInvalidData(int $code): bool
    {
        return $code === 1406;
    }

    public static function isKnown(int $code): bool
    {
        return in_array($code, [1044, 1045, 1049, 1054, 1062, 1146, 1406]);
    }
}
