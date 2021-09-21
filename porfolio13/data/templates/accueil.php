<button class="previous-button"></button>
    <div class="scene">
        <div class="carousel">
            <div class="carousel__cell celLogo">
                <img id="animated_logo" class="" src="images/OS.png" alt="animated_logo">     
            </div>

            <div class="carousel__cell celPortrait">
                <img class="portrait" src="images/portrait.jpg" alt="portrait">
            </div>

            <div href="#presentation"class="carousel__cell celPresentation">
                <a href="#presentation">                
                    <?php require ('templates/presentation.php'); ?>
                </a>
            </div>
            <div class="carousel__cell celCompetence">
                <a href="#competence">
                    <div id="sun2">
                        <svg id="svg2" width="960" height="960" font-family="sans-serif" font-size="10"></svg>
                    </div>
                </a>
            </div>

            <div class="carousel__cell celRealisation">
                <a href="#realisation">
                    <h2>Quelque real</h2>
                </a>
            </div>

            <div class="carousel__cell celActivite">
                <a href="#activite">
                    <?php require ('templates/activite.php'); ?>
                </a>
            </div>


            <div class="carousel__cell celContact">
                <a href="#contact">
                    <H2>Contactez moi</H2>
                    <!-- php require ('templates/contact.php');  -->
                </a>
            </div>
        </div>
    </div>
<button class="next-button"></button>
