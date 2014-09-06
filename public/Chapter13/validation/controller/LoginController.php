<?php

include '../model/User.php';

class LoginController {

    /**
     * @var View
     */
    private $view;

    /**
     * @var PDO
     */
    private $connection;

    /**
     * construct. Injected with PDO object.
     *
     * @param PDO $connection
     * @param View $view
     */
    public function __construct(PDO $connection, View $view)
    {
        $this->connection = $connection;
        $this->view = $view;
    }

    public function index()
    {
        return $this->view->render('login.php');
    }

    /**
     * attempts to log the user in
     *
     * attempts to find the user based on the username
     * if the user is not found, reload the login page with an error message
     * else pass the user to the logged in page
     *
     * @param array $data
     * @return void
     */
    public function login(array $data)
    {
        $user = User::findByUsername($this->connection, $data['username']);
        if (!$user) {
            $this->view->set('errors', 'username does not exist');
            $this->view->render('login.php');
        } else {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['username'] = $user->getUsername();
            header('Location: login.php');
        }
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();

        $params = session_get_cookie_params();
        setcookie(session_name(), '', strtotime('-1 year'), $params['path'], $params['domain'],
            $params['secure'], isset($params['httponly']));

        $this->view->render('index.php');
    }
}