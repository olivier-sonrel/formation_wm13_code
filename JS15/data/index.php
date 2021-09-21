<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Test JS</title>
</head>
<body>
    <h1>Test JS</h1
	<div class="flex">
        <h2 class="name">Olivier Sonrel</h2>
        <nav class="flex">
            <h3>Accueil</h3>
            <h3 class="presentation">Présentation</h3>
            <h3 class="realisation">Réalisation</h3>
            <h3 class="activite">Activités</h3>
            <h3 class="competence">Compétences</h3>
            <h3 class="contact">Contact</h3>
            <h3><span>Mon</Span> CV</h3>
        </nav>
    </div>

    <div class="right">
        <div id="presentation" class="box">Présentation</div>
        <div id="realisation" class="box">Réalisation</div>
        <div id="activite" class="box">Activités</div>
        <div id="competence" class="box">Compétences</div>
        <div id="contact" class="box">Contact</div>

    </div>

    <script type="text/javascript" src="counter.js">
</body>
</html> -->

<!doctype html>
<html>
  <head>
    <title>Console Demo</title>
  </head>
  <body>
    <h1>Hello, World!</h1>
    <script>
      console.log('Loading!');
      const h1 = document.querySelector('h1');
      console.log(h1.textContent);
      console.assert(document.querySelector('h2'), 'h2 not found!');
      const artists = [
        {
          first: 'René',
          last: 'Magritte'
        },
        {
          first: 'Chaim',
          last: 'Soutine'
        },
        {
          first: 'Henri',
          last: 'Matisse'
        }
      ];
      console.table(artists);
      setTimeout(() => {
        h1.textContent = 'Hello, Console!';
        console.log(h1.textContent);
      }, 3000);
    </script>
  </body>
</html>