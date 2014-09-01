<?php
// Start session management with a persistent cookie
$lifetime = 60 * 60 * 24 * 365;    // 1 year in seconds
session_set_cookie_params($lifetime, '/');
session_start();

//set the $task_list variable to the SESSION variable or to and empty array
$task_list = isset($_SESSION['task_list'])
    ? $_SESSION['task_list']
    : array();

$errors = array();


if (isset($_POST['action']))
{
    switch ($_POST['action'])
    {
        case 'add':
            $new_task = $_POST['newtask'];
            if (empty($new_task))
            {
                $errors[] = 'The new task cannot be empty.';
            } else
            {
                $task_list[] = $new_task;
                $_SESSION['task_list'] = $task_list;
            }
            break;
        case 'delete':
            $task_index = $_POST['taskid'];
            unset($_SESSION['task_list'][$task_index]);
            $task_list = $_SESSION['task_list'];
            break;
    }
}

include('task_list.php');
?>