<?php

namespace App\Utils;

class DateHelper
{
    public static function formatDatesToIso(array $user): array
    {
        return [
            'id'         => $user['id'],
            'name'       => $user['name'],
            'email'      => $user['email'],
            'created_at' => date(DATE_ATOM, strtotime($user['created_at'])),
            'updated_at' => date(DATE_ATOM, strtotime($user['updated_at'])),
        ];
    }
}
