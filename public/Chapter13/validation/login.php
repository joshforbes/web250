<?php

//BOOTSTRAPPING - Would need to setup namespacing on a bigger project
if (isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] === 'local') {
    @include '.env.local.php';
}
@include 'database/DatabaseConnection.php';
@include 'database/Auth.php';
@include 'view/View.php';
@include 'controller/LoginController.php';
@include 'controller/PagesController.php';
@include 'model/User.php';

$connection = DatabaseConnection::getConnection();
$view = new View();
$auth = new Auth($connection);
$loginController = new LoginController($connection, $view);
$pagesController = new PagesController($connection, $view, $auth);


//ROUTING
if (isset($_POST['username'])) {
    //login action
    $loginController->login($_POST);
} elseif (isset($_GET['login'])) {
    //login view
    $loginController->index();
} elseif (isset($_GET['logout'])) {
    //logout
    $loginController->logout();
} elseif (isset($_GET['profile'])) {
    $pagesController->profile();
} else {
    $pagesController->index();
}

