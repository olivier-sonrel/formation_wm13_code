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
    <div class="">
        <button class="button" onclick="changeRegister()">Register</button>
        <button class="button" onclick="changeConnection()">Connection</button>
    </div>
    <form id="connection" class="flex" action="controllers/connection.php" method="POST">
        <div class="button">
            <label for="name">Nom: </label>
            <input type="text" name="name" placeholder="Nom" value="<?= $_SESSION['name'] ?? '' ?>">
        </div>
        <div class="button">
            <label for="password">Mot de passe: </label>
            <input id="visualise" type="password" name="password">
            <span id="butO" onclick="afficheMdp()">0</span>
            <span class="none" id="butX" onclick="cacheMdp()">X</span>
        </div>
        <button class="button" type="submit" name="button">Send.</button>
    </form>
    <form id="register" name="register" class="" action="controllers/addUser.php" method="POST">
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
            <input type="password" name="password" required oninvalid="this.setCustomValidity('Password cannot be empty')">
        </div>
        <div class="button">
            <label for="password2">Confirm MDP: </label>
            <input type="password" name="password2" onkeyup="checkform(register)" required oninvalid="this.setCustomValidity('Password cannot be empty')">
            <span class="none alert">Mot de passe different</span>
        </div>
        <button id="send" class="button" type="submit" name="button" value="Submit" disabled>Send.</button>
    </form>
</main>

<?php require_once ('templates/footer.php'); ?>
<script src="controllers/script.js"></script>
</body>
</html>
