<?php
// var_dump($_POST);
session_start();

$image = $_POST['image'];
$text = $_POST['text'];

$_SESSION['image'] = $image;
$_SESSION['text'] = $text;

header('Location: /infos.php');

// var_dump($_SESSION);
