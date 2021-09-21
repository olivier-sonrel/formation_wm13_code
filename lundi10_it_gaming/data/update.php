<?php require ('./controllers/getOneUser.php'); ?>

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
    <form id="" name="" class="flex" action="controllers/updateUser.php" method="POST">
        <h1>Mise à jour:</h1>
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <div class="button">
            <label for="name">Nom: </label>
            <input type="text" name="name" value="<?= $user['name'] ?>">
        </div>
        <div class="button">
            <label for="description">Description: </label>
            <textarea type="description" name="description"><?= $user['description']?></textarea>
        </div>
        <button class="button" type="submit" value="Submit">MAJ</button>
    </form>
</main>

<?php require_once ('templates/footer.php'); ?>
</body>
</html>
