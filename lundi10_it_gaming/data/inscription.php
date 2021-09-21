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
    <form class="flex" action="controllers/addUser.php" method="POST">
        <h1>Inscription new user:</h1>
        <div class="button">
            <label for="name">Nom: </label>
            <input type="text" name="name" value="">
        </div>
        <div class="button">
            <label for="description">Description: </label>
            <textarea type="description" name="description"></textarea>
        </div>
        <div class="button">
            <label for="password">Mot de passe: </label>
            <input type="password" name="password">
        </div>
        <button class="button" type="submit" name="button">Send.</button>
    </form>
</main>

<?php require_once ('templates/footer.php'); ?>
   </body>
</html>
