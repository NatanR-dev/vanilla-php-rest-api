<?php 

namespace App\Services;

use App\Http\JWT;
use App\Utils\Validator;
use Exception;
use PDOException;
use App\Models\User;
use App\Utils\ServiceResponse;
use App\Utils\MySqlErrorResolver;

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

            $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);

            $user = User::save($fields);

            if (!$user) return ServiceResponse::error('Sorry, we could not create your account.');  

            return ServiceResponse::success('User created successfully.', [
                'user' => $user
            ]);

        }
        catch (PDOException $e) {

            $code = $e->errorInfo[1];

            return match (true) {
                MySqlErrorResolver::isNoPermission($code)       => ServiceResponse::error('Access denied for user.'),
                MySqlErrorResolver::isDatabaseNotFound($code)   => ServiceResponse::error('Database does not exist.'),
                MySqlErrorResolver::isDuplicateEntry($code)     => ServiceResponse::error('Sorry, user already exists.'),
                MySqlErrorResolver::isInvalidCredentials($code) => ServiceResponse::error('Invalid user or password.'),
                MySqlErrorResolver::isFieldNotFound($code)      => ServiceResponse::error('Field not found in the database.'),
                MySqlErrorResolver::isTableNotFound($code)      => ServiceResponse::error('No tables found in the database.'),
                MySqlErrorResolver::isInvalidData($code)        => ServiceResponse::error('Invalid data provided.'),
                MySqlErrorResolver::isKnown($code)              => ServiceResponse::error('Sorry, we could not create your account.'),
                default => ServiceResponse::error("Unknown database error: $code"),
            };
            
        }
        catch (Exception $e) {
            return 
                ServiceResponse::error($e->getMessage());
        }
    }

    public static function auth(array $data)
    {
        try {
            $fields = Validator::validate([
                'email'    => $data['email']    ?? '',
                'password' => $data['password'] ?? '',
            ]);

            $user = User::authentication($fields);

            if (!$user) return ServiceResponse::error('Sorry, we could not authenticate you.');

            return JWT::generate($user);
        }
        catch (PDOException $e) {

            $code = $e->errorInfo[1];

            return match (true) {
                MySqlErrorResolver::isNoPermission($code)       => ServiceResponse::error('Access denied for user.'),
                MySqlErrorResolver::isDatabaseNotFound($code)   => ServiceResponse::error('Database does not exist.'),
                MySqlErrorResolver::isDuplicateEntry($code)     => ServiceResponse::error('Sorry, user already exists.'),
                MySqlErrorResolver::isInvalidCredentials($code) => ServiceResponse::error('Invalid user or password.'),
                default => ServiceResponse::error("Unknown database error: $code"),
            };
        }
        catch (Exception $e) {
            return 
                ServiceResponse::error($e->getMessage());
        }
    }

    public static function fetch(mixed $authorization)
    {
        try {
            if (isset($authorization['error']) && $authorization['error']) {
                return ServiceResponse::error($authorization['message']);
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) {
                return ServiceResponse::error('Please, login to access this resource.');
            }

            $user = User::find($userFromJWT['id']);

            if (!$user) {
                return ServiceResponse::error('Sorry, we could not find your account.');
            }

            return $user;
            
        }
        catch (PDOException $e) {

            $code = $e->errorInfo[1];

            return match (true) {
                MySqlErrorResolver::isNoPermission($code)       => ServiceResponse::error('Access denied for user.'),
                MySqlErrorResolver::isDatabaseNotFound($code)   => ServiceResponse::error('Database does not exist.'),
                MySqlErrorResolver::isDuplicateEntry($code)     => ServiceResponse::error('Sorry, user already exists.'),
                MySqlErrorResolver::isInvalidCredentials($code) => ServiceResponse::error('Invalid user or password.'),
                default => ServiceResponse::error("Unknown database error: $code"),
            };
        }
        catch (Exception $e) {
            return 
                ServiceResponse::error($e->getMessage());
        }
    }

    public static function update(mixed $authorization, array $data)
    {
        try {
            if (isset($authorization['error']) && $authorization['error']) {
                return ServiceResponse::error($authorization['message']);
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) {
                return ServiceResponse::error('Please, login to access this resource.');
            }

            $fields = Validator::validate([
                'name' => $data['name'] ?? '',
            ]);

            $user = User::update($userFromJWT['id'], $fields);

            if (!$user) {
                return ServiceResponse::error('Sorry, we could not update your account.');
            }

            return ServiceResponse::success('User updated successfully!', [
                'user' => $user
            ]);
            
        }
        catch (PDOException $e) {

            $code = $e->errorInfo[1];

            return match (true) {
                MySqlErrorResolver::isNoPermission($code)       => ServiceResponse::error('Access denied for user.'),
                MySqlErrorResolver::isDatabaseNotFound($code)   => ServiceResponse::error('Database does not exist.'),
                MySqlErrorResolver::isDuplicateEntry($code)     => ServiceResponse::error('Sorry, user already exists.'),
                MySqlErrorResolver::isInvalidCredentials($code) => ServiceResponse::error('Invalid user or password.'),
                default => ServiceResponse::error("Unknown database error: $code"),
            };
        }
        catch (Exception $e) {
            return 
                ServiceResponse::error($e->getMessage());
        }
    }

    public static function delete(mixed $authorization, int|string $id)
    {
        try {
            if (isset($authorization['error']) && $authorization['error']) {
                return ServiceResponse::error($authorization['message']);
            }

            $userFromJWT = JWT::verify($authorization);

            if (!$userFromJWT) {
                return ServiceResponse::error('Please, login to access this resource.');
            }

            $user = User::delete($id);

            if (!$user) {
                return ServiceResponse::error('Sorry, we could not delete your account.');
            }

            return ServiceResponse::success('User deleted successfully!', [
                'user' => $user
            ]);
            
        }
        catch (PDOException $e) {

            $code = $e->errorInfo[1];

            return match (true) {
                MySqlErrorResolver::isNoPermission($code)       => ServiceResponse::error('Access denied for user.'),
                MySqlErrorResolver::isDatabaseNotFound($code)   => ServiceResponse::error('Database does not exist.'),
                MySqlErrorResolver::isDuplicateEntry($code)     => ServiceResponse::error('Sorry, user already exists.'),
                MySqlErrorResolver::isInvalidCredentials($code) => ServiceResponse::error('Invalid user or password.'),
                default => ServiceResponse::error("Unknown database error: $code"),
            };
        }
        catch (Exception $e) {
            return 
                ServiceResponse::error($e->getMessage());
        }
    }
}