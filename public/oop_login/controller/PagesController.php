<?php

class PagesController {

    /**
     * @var View
     */
    private $view;

    /**
     * @var PDO
     */
    private $connection;

    /**
     * @var Auth
     */
    private $auth;

    /**
     * @param PDO $connection
     * @param View $view
     * @param Auth $auth
     */
    public function __construct(PDO $connection, View $view, Auth $auth)
    {
        $this->connection = $connection;
        $this->auth = $auth;
        $this->view = $view;
    }

    public function index()
    {
        $this->view->set('auth', $this->auth);
        if ($this->auth->loggedIn()) {
            $this->view->set('username', $_SESSION['username']);
        }
        $this->view->render('index.php');
    }

    public function profile()
    {
        $user = User::findByUsername($this->connection, $_SESSION['username']);
        $this->view->set('auth', $this->auth);
        $this->view->set('username', $user->getUsername());
        $this->view->set('userLevel', $user->getUserLevel());
        $this->view->render('profile.php');
    }

}