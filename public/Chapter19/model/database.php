<?php

if (isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] === 'local') {
    putenv('host=localhost');
    putenv('database=my_guitar_shop2');
    putenv('username=homestead');
    putenv('password=secret');
}

$dsn = 'mysql:host=' . getenv('host') . ';dbname=' . getenv('database');
$username = getenv('username');
$password = getenv('password');
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include 'errors/db_error_connect.php';
    exit;
}

function display_db_error($error_message) {
    global $app_path;
    include 'errors/db_error.php';
    exit;
}
?>