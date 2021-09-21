<?php

// var_dump($_GET);


$id = $_GET['id'];
echo $id;

$db = new PDO('mysql:host=localhost; dbname=gaming; charset=utf8', 'root', '0000'); // connexion DB
$req = $db->prepare("DELETE FROM users WHERE id = $id"); // prepare requete
// $req = $db->prepare("DELETE FROM users WHERE :id = $id");................
// $req->bindParam(':id', $_POST['id']);
$req->execute(); // execute requete
header('Location: /user_admin.php');
