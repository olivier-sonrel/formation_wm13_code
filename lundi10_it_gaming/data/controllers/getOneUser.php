<?php

$db = new PDO('mysql:host=localhost; dbname=gaming; charset=utf8', 'root', '0000'); 
$req = $db->prepare('SELECT * FROM users WHERE id=:id');  
$req->bindParam(':id', $_GET['id']);                                       
$req->execute();                                                                    
$user = $req->fetch(PDO::FETCH_ASSOC); 

// var_dump($user); die;