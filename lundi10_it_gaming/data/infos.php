<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="icon" type="image/png" href="/images/favicon.png">
        <title>TRUE-GAMER</title>
    </head>
    <body>

<?php require_once ('templates/header.php'); ?>

<main class="flex">
    <div class="flex infos">
        <?php if (isset($_SESSION['connected'])): ?>
            <?php if ($_SESSION['image'] == 1): ?>
                <img src="/images/arrow.png" alt="">
            <?php endif ?>
            <?php if ($_SESSION['text'] == 1): ?>
                <h1>SHOOTED!!!!!</h1>
                <?php else: ?>
                    <div class="text-vide">
                    </div>
            <?php endif ?>
        <?php else: ?>
            <?php require_once ('templates/error.php'); ?>
        <?php endif ?>
    </div>
</main>

<?php require_once ('templates/footer.php'); ?>
    </body>
</html>
