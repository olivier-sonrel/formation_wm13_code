<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="favicon.ico" />
        <link rel="stylesheet" media="screen and (min-width: 641px)" href="css/screen-style.css" type="text/css" />
        <link rel="stylesheet" media="screen and (max-width: 640px)" href="css/mobile-style.css" type="text/css" />
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/emailjs-com@2.4.1/dist/email.min.js"></script>
        <script type="text/javascript">(function(){emailjs.init('user_l4bXqEQv7nGZ7wHMnR9dB');})();</script>
        <script type="text/javascript">
            window.onload = function() {
                document.getElementById('contact-form').addEventListener('submit', function(event) {
                    event.preventDefault();
                    // generate the contact number value
                    this.contact_number.value = Math.random() * 100000 | 0;
                    emailjs.sendForm('contact_service', 'contact_form', this);
                });
            }
        </script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <title>Porfolio Olivier Sonrel</title>
</head>
<body class="flexFull">

    <section id="accueil" class="flex nasa-background">
        <?php require ('templates/accueil.php'); ?>
    </section>
    <header class="flex contentWrap">
        <?php require ('templates/header.php'); ?>
    </header>

<main class="slider-wrap mobile-none">
<div id="slider" class="slider">
    <div class="holder">
        <div class="slide-wrapper">
            <section id="presentation" class="flexCol slide">
                <?php require ('templates/presentation.php'); ?>
            </section>
        </div>
    
        <div class="slide-wrapper">
            <section id="realisation" class="flexCol slide">
                <?php require ('templates/realisation.php'); ?>   
            </section>
        </div>
    
        <!-- <div class="slide-wrapper">
            <section id="activite" class="flexCol slide">
                <?php require ('templates/activite.php'); ?>
            </section>
        </div> -->
    
        <div class="slide-wrapper">
            <section id="competence" class="flexCol slide">
                <?php require ('templates/competence.php'); ?>
            </section>
        </div>

        <div class="slide-wrapper">
            <section id="contact" class="flexCol slide">
                <?php require ('templates/contact.php'); ?>
            </section>
        </div>
    </div>
</div>


</main>

<footer class="mobile-none">
    <?php require ('templates/footer.php'); ?>
</footer>

<script src="scripts/jquery.js"></script>
<script src="scripts/apod.js"></script>
<script src="scripts/suivi.js"></script>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="competence/scale.js"></script>
<script src="competence/d31.js" charset="utf-8"></script>
<script src="competence/d32.js" charset="utf-8"></script>
<script src="competence/d33.js" charset="utf-8"></script>
<script src="scripts/carousel.js"></script>
<script src="scripts/slider.js"></script>
<script src="scripts/real.js"></script>
</body>
</html>
