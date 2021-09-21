<?php

$db = new PDO('mysql:host=localhost; dbname=validation; charset=utf8', 'root', '0000');
$req = $db->prepare('SELECT * FROM book');
$req->execute();
$books = $req->fetchAll(PDO::FETCH_ASSOC);

// var_dump($books);
// die;