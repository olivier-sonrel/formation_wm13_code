<?php require ('./controllers/getAllUsers.php'); ?>

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
    <?php if (isset($_SESSION['connected'])): ?>
        <div id="table" class="flex">
            <h1>ceci est le tab user.</h1>
            <?php foreach ($users as $user) :?>
                <div class="ligne flex">
                    <h2><?= $user['name']?></h2>
                    <p><?= $user['description']?></p>
                    <a class="button" href="controllers/delUser.php?id=<?=$user['id']?>">Delete!!!</a>
                    <a class="button" href="update.php?id=<?=$user['id']?>">MAJ</a>
                    <!-- Jon way n -->
                    <!-- <form action="./controllers/delUser" method="POST">
                        <input type="hidden" name="id" value="<?= $user['id']?>">
                        <input type="submit" value="X">
                    </form> -->
                </div>
            <?php endforeach ?>
        </div>
    <?php else: ?>
        <?php require_once ('templates/error.php'); ?>
    <?php endif ?>
</main>

<?php require_once ('templates/footer.php'); ?>
    </body>
</html>
