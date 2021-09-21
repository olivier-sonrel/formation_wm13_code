<?php

$db = new PDO('mysql:host=localhost; dbname=gaming; charset=utf8', 'root', '0000'); // connexion DB
$req = $db->prepare('SELECT * FROM users'); // prepare requete
$req->execute(); // execute requete
$users = $req->fetchAll(PDO::FETCH_ASSOC); // requp data et met en forme

// var_dump($users);
// die;
