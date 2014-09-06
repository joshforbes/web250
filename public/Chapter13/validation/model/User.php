<?php

class User {

    private $username;

    private $userLevel;

    protected static $table = 'chapter13';

    /**
     * create a User instance from supplied data
     * if the data contains a $password then hash it and store
     * as $hashedPassword
     *
     * @param PDO $connection
     * @param array $data info required for User instance
     */
    public function __construct(\PDO $connection, array $data)
    {
        $this->connection = $connection;

        $this->username = (string)$data['username'];
        $this->userLevel = (string)$data['userLevel'];
    }


    /**
     * allows Users to be searched by username
     *
     * @param  PDO $connection
     * @param  string $username
     * @return User|false    new User instance or false
     */
    public static function findByUsername(\PDO $connection, $username)
    {
        try
        {
            $query = $connection->prepare("SELECT * from " . self::$table . " WHERE username = :username LIMIT 1");
            $query->bindParam(':username', $username);
            $query->execute();

            return ($query->rowCount() === 1)
                ? new self($connection, $query->fetch(\PDO::FETCH_ASSOC))
                : false;
        } catch (\PDOException $e)
        {
            return false;
        }
    }

    /**
     * getter for $userLevel
     *
     * @return string indicates a users level (admin or member)
     */
    public function getUserLevel()
    {
        return $this->userLevel;
    }

    public function getUsername()
    {
        return $this->username;
    }

}