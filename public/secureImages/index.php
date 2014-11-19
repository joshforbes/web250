<?php

if (isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] === 'local') {
    @include '.env.local.php';
}

require 'vendor/autoload.php';
include 'database/DatabaseConnection.php';
include 'view/View.php';
include 'controller/PagesController.php';
include 'controller/ImagesController.php';
include 'model/Image.php';

//INSTANTIATE
//Would be handled by router and dispatcher on a larger project,
//but felt like overkill for this
$connection = DatabaseConnection::getConnection();
$view = new View();
$pagesController = new PagesController($connection, $view);
$imagesController = new ImagesController($connection, $view);

if (!empty($_FILES)) {
    $imagesController->upload();
}

if (isset($_GET['delete']) && isset($_GET['id']))
{
    //login action
    $imagesController->delete($_GET['id']);
}

$pagesController->index();



