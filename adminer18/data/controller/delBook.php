<?php

$id = $_GET['id'];
echo $id;

$db = new PDO('mysql:host=localhost; dbname=validation; charset=utf8', 'root', '0000');
$req = $db->prepare("DELETE FROM book WHERE id = $id");
$req->execute();
header('Location: /book.php');
