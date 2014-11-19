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

        $images = Image::findAll($this->connection);
        $this->view->set('images', $images);

        $this->view->render('index.php');
    }

}