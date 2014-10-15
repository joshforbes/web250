<?php

class Auth
{
    /**
     * @var string
     */
    private $username;

    /**
     * the database connection
     *
     * @var PDO
     */
    private $connection;

    /**
     * the auth class will only be used with sessions, so to begin
     * the constuctor starts a session if it isn't already set
     * also pulls the username from the session array if it is set
     *
     * @param PDO $connection
     */
    public function __construct(PDO $connection) {
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->connection = $connection;
        $this->username = isset($_SESSION['username'])
            ? $_SESSION['username']
            : null;
    }

    /**
     * checks to see if the user is logged in,
     * by checking to see if session username is set
     *
     * @return boolean true|false returns true if user is logged in
     */
    public function loggedIn()
    {
        if (isset($this->username)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * checks to see if current user privledge level is admin
     *
     * @return boolean returns true if user is admin
     */
    public function isAdmin()
    {
        $user = User::findByUsername($this->connection, $this->username);
        if ($user && $user->getUserLevel() === 'admin') {
            return true;
        } else {
            return false;
        }
    }

}