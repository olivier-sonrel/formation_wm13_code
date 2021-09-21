<?php

echo "a\n |\n |b______c\n";

echo "Rentre AB:\n";
$ab = fread(STDIN, 80);

echo "Rentre BC:\n";
$bc = fread(STDIN, 80);

$hypoCarre = pow(2, $ab) + pow(2, $bc);
$hypo = sqrt($hypoCarre);

echo "l'hypo est $hypo.";

 ?>
