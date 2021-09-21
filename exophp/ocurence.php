<?php

$resultat = 0;

echo "Rentrez un blabla: ";
$blabla = fread(STDIN, 80);
$blablaTab = str_split($blabla);

echo "\nRentrez une lettre: ";
$lettre = fread(STDIN, 1);

foreach ($blablaTab as $value) {
  if ($value == $lettre) {$resultat++;}
}

echo "\nIl y a $resultat lettre $lettre dans $blabla.";

 ?>
