<?php 

namespace App\Services;

use App\Utils\Validator;

class UserService
{
    public static function create(array $data)
    {
        try{
            $fields = Validator::validate([
                'name'     => $data['name']     ?? '',
                'email'    => $data['email']    ?? '',
                'password' => $data['password'] ?? '',
            ]);

            return $fields;

        }
        catch (\Exception $e) {
            return ['error' => $e ->getMessage()];
        }
    }
}