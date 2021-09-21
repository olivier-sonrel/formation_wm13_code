<?php

require './classes/Voiture.php';

$voiture1 = new Voiture('blue', 100);
$voiture2 = new Voiture('red', 50);
$voiture3 = new Voiture('violet', 80);

$voiture1->avancer();
echo '</br>';
$voiture1->color('vert');

$voiture2->color('bleu');


var_dump($voiture1, $voiture2, $voiture3);
echo $voiture1->avancer();
echo '</br>';
echo $voiture1->avancer();
echo '</br>';
echo $voiture1->avancer();
echo '</br>';
echo $voiture1->avancer();
echo '</br>';
var_dump($voiture1);
$voiture2->donnerEssence($voiture1);
// echo $voiture1->faireLePlein();
// echo '</br>';
var_dump($voiture1, $voiture2);
