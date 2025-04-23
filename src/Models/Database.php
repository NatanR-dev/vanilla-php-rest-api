<?php 

namespace App\Models;

use PDO;

class Database
{
    public static function getConnection()
    {
        $pdo = new PDO("mysql:host=db;dbname=app_db", "user", "user_password");
        return $pdo;
    }
} 