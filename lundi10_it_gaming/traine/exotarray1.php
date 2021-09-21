<?php
$arr = ['marc','paul','georgette'];

array_push($arr,'lucienne');
print_r($arr);

echo "</br></br>change paul/martin: </br>";
$arr[1]= 'martin';
print_r($arr);

echo "</br></br>Ajoute Tab2 a tab1: </br>";
$arr2 = ['martine', 45,'franck','rouge'];
$arr = array_merge($arr , $arr2);
var_dump($arr);

echo "</br></br>lit fin du tableau </br>";
print_r(end($arr));

echo "</br></br>Affiche element 2 a 5: </br>";
print_r(array_slice($arr, 2, 4));

echo "</br></br>Recup premiere element et l'enleve: </br>";
$prems = array_shift($arr);
echo "Premier element: $prems</br>";
print_r($arr);

echo "</br></br> Inverse tablo: </br>";
$arr = array_reverse($arr);
print_r($arr);
