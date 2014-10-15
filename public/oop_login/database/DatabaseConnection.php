<?php

class DatabaseConnection {

    /**
     * database connection
     *
     * @var PDO
     */
    private static $connection;

    /**
     * attempt to connect to the database specified by the settings
     * in a $_ENV.
     *
     * @throws false for now - if connection fails return false. Refactor eventually to handle this gracefully.
     */
    private function __construct()
    {
        try
        {
            $connection = new \PDO('mysql:host=' . getenv('host') . ';dbname=' . getenv('database'),
                getenv('username'), getenv('password'));

            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$connection = $connection;
        } catch (\PDOException $e)
        {
            return false;
        }
    }

    /**
     * singleton for connection. Either gets the current connection or creates
     * a connection if it doesn't already exist.
     *
     * @return DatabaseConnection  returns a database connection
     */
    public static function getConnection()
    {
        if (!self::$connection)
        {
            new DatabaseConnection();
        }

        return self::$connection;
    }

}