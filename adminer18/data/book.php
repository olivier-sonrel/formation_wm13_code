<?php require ('./controller/getAllBooks.php'); ?>

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
        <h1>Look at all you have...</h1>
    </div>
            <?php foreach ($books as $book) :?>
                <div class="ligne flex button">
                    <h2><?= $book['title']?></h2>
                    <h3><?= $book['author']?></h3>
                    <p><?= $book['description']?></p>
                    <a class="button" href="controller/delBook.php?id=<?=$book['id']?>">Beurk, ça dégage.</a>
                    <a class="button" href="update.php?id=<?=$book['id']?>">Houlala faut modifier ça???</a>
                </div>
            <?php endforeach ?>
        </div>
</main>

<?php require_once ('templates/footer.php'); ?>
    </body>
</html>