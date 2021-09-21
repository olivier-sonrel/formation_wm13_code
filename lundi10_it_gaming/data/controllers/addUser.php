<?php

// var_dump($POST);
// die;

$name = $_POST['name'];
$description = $_POST['description'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

if ($password == $password2) {
    $password = md5($password);
    $db = new PDO('mysql:host=localhost; dbname=gaming; charset=utf8', 'root', '0000'); // connexion DB
    $req = $db->prepare("INSERT INTO users (name, password, description) VALUES (:name, :password, :description)"); // prepare requete
    $req->bindParam(':name', strtolower($name));   //despecialise chaine pour eviter faille sql
    $req->bindParam(':password', $password);   //despecialise chaine pour eviter faille sql
    $req->bindParam(':description', $description);   //despecialise chaine pour eviter faille sql

    $req->execute(); // execute requete
    header('Location: /');
    exit;
}

else {
    header('Location: /login.php');
    exit;
}
