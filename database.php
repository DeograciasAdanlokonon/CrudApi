<?php

class Database
{
    // //LOCALHOST DATA
    private static $dbHost = "localhost";
    private static $dbName = "tutorialcrud";
    private static $dbUser = "root";
    private static $dbPassword ="";

    private static $connection = null;

    public static function connect()
    {
        try 
        {
            self::$connection = new PDO("mysql:host=" .self::$dbHost.";dbname=" .self::$dbName, self::$dbUser, self::$dbPassword);
        } 
        catch (PDOException $e) 
        {
            echo 'Echec de connexion à la base de données:' .$e->getMessage();
        }
        return self::$connection;
    }

    public static function disconnect()
    {
        self::$connection = null;
    }
}
Database::connect();

?>