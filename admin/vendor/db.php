<?php

class Database
{
    private static $hostName = 'localhost';
    private static $dbName = 'perfectcup';
    private static $username = 'root';
    private static $password = '';
    private static $connection;

    public static function connect()
    {
        if (self::$connection == null) {
            try {
                self::$connection = new PDO("mysql:host=" . self::$hostName . ";dbname=" . self::$dbName, self::$username, self::$password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        return self::$connection;
    }

    public static function disConnect()
    {
        self::$connection = null;
    }
}
