<?php

$title = $_POST['title'];
$author = $_POST['author'];
$description = $_POST['description'];

$db = new PDO('mysql:host=localhost; dbname=validation; charset=utf8', 'root', '0000');
$req = $db->prepare("INSERT INTO book (title, author, description) VALUES (:title, :author, :description)");
$req->bindParam(':title', $title); 
$req->bindParam(':author', $author);
$req->bindParam(':description', $description);

$req->execute();
header('Location: /book.php');