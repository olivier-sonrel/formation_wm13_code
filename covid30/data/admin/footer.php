        </div>
        <!-- Main content area end -->

        
        <!-- Footer area start-->
        <footer class="do-not-print">
            <div class="footer-area">
                <?php
                $q = $pdo->prepare("SELECT * FROM tbl_setting_footer WHERE id=1");
                $q->execute();
                $result = $q->fetchAll();
                foreach ($result as $row) {
                    echo '<p>'.$row['copyright'].'</p>';
                }
                ?>
            </div>
        </footer>
        <!-- Footer area end-->

    </div>
    <!-- Page container area end -->


    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>

    <!-- Basic -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <!-- <script src="assets/ckeditor/ckeditor.js"></script> -->
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

    <!-- Datatable -->
    <script src="assets/js/jquery.dataTables.min.js"></script>

    <!-- Amcharts -->
    <script src="assets/js/amcharts.js"></script>
    <script src="assets/js/serial.js"></script>
    
    <!-- Bar chart -->
    <script src="assets/js/bar-chart.js"></script>

    <!-- Datepicker for bootstrap 4 -->
    <script src="assets/js/gijgo.min.js"></script>

    <!-- Others -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

    <script>
        <?php
        $statement = $pdo->prepare("SELECT * FROM tbl_setting_home WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $header_type = $row['header_type'];
        }
        ?>

        <?php if($header_type == 'Slider'): ?>
            document.getElementById('showImageContent').style.display = "none";
            document.getElementById('showVideoContent').style.display = "none";

        <?php elseif($header_type == 'Image'): ?>
            document.getElementById('showVideoContent').style.display = "none";

        <?php elseif($header_type == 'Video'): ?>
            document.getElementById('showImageContent').style.display = "none";
            
        <?php endif; ?>

        function showContent(elem) 
        {
            if( elem.value == 'Slider') 
            {
                document.getElementById('showImageContent').style.display = "none";
                document.getElementById('showVideoContent').style.display = "none";
            }
            else if( elem.value == 'Image') 
            {
                document.getElementById('showImageContent').style.display = "block";
                document.getElementById('showVideoContent').style.display = "none";
            } 
            else if( elem.value == 'Video') 
            {
                document.getElementById('showImageContent').style.display = "none";
                document.getElementById('showVideoContent').style.display = "block";
            }
        }
    </script>

</body>
</html>