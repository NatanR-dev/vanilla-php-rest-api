<?php 

namespace App\Services;

use App\Utils\Validator;
use Exception;
use PDOException;
use App\Models\User;
use App\Utils\ServiceResponse;
use App\Utils\MysqlErrorResolver;

class UserService
{
    public static function create(array $data)
    {
        try {
            //var_dump($data); 

            $fields = Validator::validate([
                'name'     => $data['name']     ?? '',
                'email'    => $data['email']    ?? '',
                'password' => $data['password'] ?? '',
            ]);

            $user = User::save($fields);

            if (!$user) return ServiceResponse::error('Sorry, we could not create your account.');  

            return ServiceResponse::success('User created successfully.', [
                'user' => $user
            ]);

        }
        catch (PDOException $e) {

            $code = $e->errorInfo[1];

            return match (true) {
                MysqlErrorResolver::isNoPermission($code)       => ServiceResponse::error('Access denied for user.'),
                MysqlErrorResolver::isDatabaseNotFound($code)   => ServiceResponse::error('Database does not exist.'),
                MysqlErrorResolver::isDuplicateEntry($code)     => ServiceResponse::error('Sorry, user already exists.'),
                MysqlErrorResolver::isInvalidCredentials($code) => ServiceResponse::error('Invalid user or password.'),
                default => ServiceResponse::error("Unknown database error: $code"),
            };
            
        }
        catch (Exception $e) {
            return 
                ServiceResponse::error($e->getMessage());
        }
    }
}