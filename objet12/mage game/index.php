<?php

// Parcour classes/ et require tout fichier dedans
spl_autoload_register(function ($class_name) {
    require 'classes/' . $class_name . '.php';
});


$player1 = new Wizard('Toto');
$player2 = new Wizard('Tata');
$n = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?php while ($player1->isAlive() && $player2->isAlive()): ?>
    <?php $n ++ ?>
    <h2 class="round"><?= "Turn $n..." ?></h2>
    <?= $player1->action($player2)?>
    </br>
    <?php $status = "{$player1->name} a gagné!" ?>
    <?php if($player2->isAlive()): ?>
        <?= $player2->action($player1) ?>
        <?php $status = "{$player2->name} a gagné!" ?>
    <?php endif ?>
    </br>
<?php endwhile ?>
<h1><?= $status?></h1>
    
</body>
</html>


