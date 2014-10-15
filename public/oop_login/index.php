<?php

//BOOTSTRAPPING - Would need to setup namespacing and PSR-4 autoloading on a bigger project
//The APP_ENV is a product of my server database setup
if (isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] === 'local') {
    @include '.env.local.php';
}
@include 'database/DatabaseConnection.php';
@include 'database/Auth.php';
@include 'view/View.php';
@include 'controller/SessionsController.php';
@include 'controller/PagesController.php';
@include 'model/User.php';

//INSTANTIATE
//Would be handled by router and dispatcher on a larger project,
//but felt like overkill for this
$connection = DatabaseConnection::getConnection();
$view = new View();
$auth = new Auth($connection);
$sessionsController = new SessionsController($connection, $view);
$pagesController = new PagesController($connection, $view, $auth);


//ROUTING
if (isset($_POST['username'])) {
    //login action
    $sessionsController->login($_POST);
} elseif (isset($_GET['login'])) {
    //login view
    $sessionsController->index();
} elseif (isset($_GET['logout'])) {
    //logout
    $sessionsController->logout();
} elseif (isset($_GET['profile'])) {
    $pagesController->profile();
} else {
    $pagesController->index();
}

