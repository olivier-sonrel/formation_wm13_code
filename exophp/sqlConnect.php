<?php
$mysqli = new mysqli("localhost", "testeur", "plouf", "mysql_pays");
if ($mysqli->connect_errno) {
echo "Echec lors de la connexion à MySQL testeur : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";

/*$mysqli = new mysqli("127.0.0.1", "root", "Taktot9686?", "mysql_pays", 3306);
if ($mysqli->connect_errno) {
echo "Echec lors de la connexion à MySQL root : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

echo $mysqli->host_info . "\n";*/
?>
