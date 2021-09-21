<?php
//var_dump($_POST);

session_start();

require 'getAllUsers.php';

$name = strtolower($_POST['name']);
$password = $_POST['password'];

foreach ($users as $user) {
    if ($name == $user['name'] && md5($password) == $user['password']) {
        $_SESSION['image'] = 1;
        $_SESSION['text'] = 1;
        $_SESSION['name'] = $name;
        $_SESSION['connected'] = TRUE;
        header('Location: /');
        exit;
    }
}

$_SESSION['name'] = $name;
header('Location: /login.php');
exit;


//var_dump($_SESSION);
