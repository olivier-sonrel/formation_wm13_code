<?php

$db = new PDO('mysql:host=localhost; dbname=validation; charset=utf8', 'root', '0000'); 
$req = $db->prepare('SELECT * FROM book WHERE id=:id');  
$req->bindParam(':id', $_GET['id']);                                       
$req->execute();                                                                    
$book = $req->fetch(PDO::FETCH_ASSOC); 

// var_dump($book); die;