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
    <?php if (!isset($_SESSION['connected'])): ?>
            <?php require_once ('templates/error.php'); ?>
        <?php else: ?>
    <form class="flex" action="/controllers/user_profil.php" method="POST">
        <div class="button">
            <p>Tu veux le texte?</p>
            <label for="">Oui</label>
            <input type="radio" name="text" value="1" <?= $_SESSION['text'] ? 'checked' : '' ?>>
            <label for="">Non</label>
            <input type="radio" name="text" value="0" <?= !$_SESSION['text'] ? 'checked' : '' ?>>
        </div>
        <div class="button">
            <p>Tu veux l'image?</p>
            <label for="">Oui</label>
            <input type="radio" name="image" value="1" checked>
            <label for="">Non</label>
            <input type="radio" name="image" value="0" <?php if (!$_SESSION['image']) {echo 'checked';} ?>> 
        </div>
        <div>
          <button class="button" type="submit">Valider.</button>
        </div>
    </form>
<?php endif ?>
</main>

<?php require_once ('templates/footer.php'); ?>
    </body>
</html>
