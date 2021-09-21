<?php require ('./controller/getOneBook.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="icon" type="image/png" href="/images/favicon.png">
        <title>La bibiliotéque</title>
    </head>
    <body>

<?php require_once ('templates/header.php'); ?>

<main class="flex column">
        <div class="flex main_title">
            <h1>Bon bein faut changer tout ça...</h1>
        </div>
        <form id="upbook" name="upbook" class="" action="controller/updateBook.php" method="POST">
        <input type="hidden" name="id" value="<?= $book['id'] ?>">
            <div class="button">
                <label for="title">Titre: </label>
                <input type="text" name="title" value="<?= $book['title'] ?>">
            </div>
            <div class="button">
                <label for="author">Auteur: </label>
                <input type="text" name="author" value="<?= $book['author'] ?>">
            </div>
            <div class="button">
                <label for="description">Description: </label>
                <textarea type="description" name="description" rows="5" cols="33"><?= $book['description'] ?></textarea>
            </div>
            <button id="send" class="button" type="submit" name="button" value="Submit">Send.</button>
    </form>
</main>

<?php require_once ('templates/footer.php'); ?>
    </body>
</html>