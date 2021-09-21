<?php

$db = new PDO('mysql:host=localhost; dbname=validation; charset=utf8', 'root', '0000');
$req = $db->prepare("UPDATE book SET title = :title, author = :author, description = :description WHERE id = :id");
$req->bindParam(':title', $_POST['title']);
$req->bindParam(':author', $_POST['author']);
$req->bindParam(':description', $_POST['description']);
$req->bindParam(':id', $_POST['id']);
$req->execute();

header('Location: /book.php');
