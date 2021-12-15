<?php

namespace Core;

use PDO;
use App\Config;

/**
 * Base model
 * 
 * PHP version 8.0.7
 */
abstract class Model
{
    /**
     * Get the PDO database connection
     * 
     * @return mixed
     */
    protected static function getDB()
    {
        // Is only called the first time the method is called
        static $db = null;

        if ($db === null) {

            $dsn = 'mysql:host=' . Config::DB_HOST .
                ';dbname=' . Config::DB_NAME .
                ';charset=utf8';
            // $dsn="mysql:host=localhost;dbname=mvc;charset=utf8";

            $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
            //$db=object(PDO)#3 (0) {}

            // Throw an exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }
}
