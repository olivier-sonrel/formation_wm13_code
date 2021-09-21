<?php

echo "Rentrez un nombre: \n";
$nbr = fread(STDIN, 80);

$mod = (int)$nbr % 2;

if ($mod == 0) {
  echo 'Donc ', $nbr, 'est pair.';
}elseif ($mod == 1) {
  echo 'Donc ', $nbr, 'est impair.';
}else {
  echo "Y a un bleme...";
}

 ?>
