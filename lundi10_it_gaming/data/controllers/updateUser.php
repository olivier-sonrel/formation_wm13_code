<?php

$db = new PDO('mysql:host=localhost; dbname=gaming; charset=utf8', 'root', '0000'); // connexion DB
$req = $db->prepare("UPDATE users SET name = :name, description = :description WHERE id = :id"); // prepare requete
$req->bindParam(':name', $_POST['name']);
$req->bindParam(':description', $_POST['description']);
$req->bindParam(':id', $_POST['id']);
$req->execute(); // execute requete

header('Location: /user_admin.php');

// var_dump($users);
// die;