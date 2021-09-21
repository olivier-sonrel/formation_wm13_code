<?php

spl_autoload_register(function ($class) {
    require 'classes/' . $class . '.php';
});

//$player1 = new Mage('Magicien');
$player1 = new Warrior('Guerrier');
$player2 = new Archer('Archer');

// Characters attacking while both alive
while ($player1->isAlive() && $player2->isAlive()) {
    //var_dump($player1, $player2);//controle----------------------------
    // First Character attacking the 2nd
    echo $player1->action($player2);
    // Check if target is alive
    if (!$player2->isAlive()) {
        echo '<br>';
        echo "$player2->pseudo est KO!";
    };
    echo '<br>';

    // Second Character attaking the first
    if ($player2->isAlive()) {
        echo $player2->action($player1);
    };

    // Check if target is alive
    if (!$player1->isAlive()) {
        echo '<br>';
        echo "$player1->pseudo est KO!";
    };
    echo '<br>';
    echo '<br>';
}