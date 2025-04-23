<?php 

namespace App\Services;

use App\Utils\Validator;
use Exception;
use PDOException;
use App\Models\User;
use App\Utils\ServiceResponse;

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

            if ($e->errorInfo[1] == 1044) {
                    return ServiceResponse::error('User does not have permission to access the database.');
                }
                
            if ($e->errorInfo[1] == 1049) {
                return ServiceResponse::error('Database does not exist.');
                }
                
            if ($e->errorInfo[1] == 1062) {
                return ServiceResponse::error('Sorry, user already exists.');
                }

            if ($e->errorInfo[1] == 1045) {
                return ServiceResponse::error('User or password is incorrect.');
                }
                
            return [
                'error' => 'Database error: ' . $e->errorInfo[1],
                //'error' => 'Database error: ' .  $e->errorInfo[2],
                //'message' => 'Database error: ' . $e->getMessage();
            ];
        }
        catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }
}