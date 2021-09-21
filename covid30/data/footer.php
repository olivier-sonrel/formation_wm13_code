		<?php
		$cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

		$q = $pdo->prepare("SELECT * FROM tbl_setting_footer WHERE id=1");
		$q->execute();
		$result = $q->fetchAll();
		foreach ($result as $row) {
			$copyright = $row['copyright'];
			$footer_address = $row['footer_address'];
			$footer_email = $row['footer_email'];
			$footer_phone = $row['footer_phone'];
		}
		?>
		<div class="footer-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="footer-item footer-service">
							<h2>Important Links</h2>
							<ul class="fmain">
								<?php
								$q = $pdo->prepare("SELECT * FROM tbl_footer_link ORDER BY order1 ASC");
								$q->execute();
								$res = $q->fetchAll();
								foreach ($res as $row) {
									?>
									<li><a href="<?php echo safe_data($row['url']); ?>"><?php echo safe_data($row['name']); ?></a></li>
									<?php
								}
								?>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="footer-item footer-service">
							<h2>Pages</h2>
							<ul class="fmain">
								<?php
								$q = $pdo->prepare("SELECT * 
													FROM tbl_footer_page t1
													JOIN tbl_page t2
													ON t1.page_id = t2.page_id
													ORDER BY t1.order1 ASC");
								$q->execute();
								$res = $q->fetchAll();
								foreach ($res as $row) {
									?>
									<li><a href="<?php echo BASE_URL.'page/'.$row['page_slug']; ?>"><?php echo safe_data($row['page_name']); ?></a></li>
									<?php
								}
								?>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="footer-item footer-contact">
							<h2>Contact</h2>
							<ul>
								<li><?php echo safe_data($footer_address); ?></li>
								<li><?php echo safe_data($footer_email); ?></li>
								<li><?php echo safe_data($footer_phone); ?></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="footer-item footer-service">
							<h2>Social Media</h2>
							<div class="footer-social-link">
								<ul>
									<?php
									$q = $pdo->prepare("SELECT * FROM tbl_social WHERE social_status=? ORDER BY social_order ASC");
									$q->execute([1]);
									$res = $q->fetchAll();
									foreach ($res as $row) {
										?>
										<li><a href="<?php echo safe_data($row['social_url']); ?>" target="_blank"><i class="<?php echo safe_data($row['social_icon']); ?>"></i></a></li>
										<?php
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="copyright">
							<p><?php echo safe_data($copyright); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>

      	<div class="scroll-top">
	        <i class="fa fa-angle-up"></i>
	    </div>

	    <?php
	    $q = $pdo->prepare("SELECT * FROM tbl_setting_payment WHERE id=1");
		$q->execute();
		$result = $q->fetchAll();                            
		foreach ($result as $row) {
		    $stripe_public_key = $row['stripe_public_key'];
		    $stripe_secret_key = $row['stripe_secret_key'];
		}
	    ?>
		
		<script src="<?php echo BASE_URL; ?>js/custom.js"></script>
		<script>
			$(document).on('submit', '#stripe_form', function () {
		        // createToken returns immediately - the supplied callback submits the form if there are no errors
		        $('#submit-button').prop("disabled", true);
		        $("#msg-container").hide();
		        Stripe.card.createToken({
		            number: $('.card-number').val(),
		            cvv: $('.card-cvv').val(),
		            exp_month: $('.card-expiry-month').val(),
		            exp_year: $('.card-expiry-year').val()
		            //name: $('.card-holder-name').val()
		        }, stripeResponseHandler);
		        return false;
		    });
		    Stripe.setPublishableKey('<?php echo $stripe_public_key; ?>');
		    function stripeResponseHandler(status, response) {
		        if (response.error) {
		            $('#submit-button').prop("disabled", false);
		            $("#msg-container").html('<div style="color: red;border: 1px solid;margin: 10px 0px;padding: 5px;"><strong>Error:</strong> ' + response.error.message + '</div>');
		            $("#msg-container").show();
		        } else {
		            var form$ = $("#stripe_form");
		            var token = response['id'];
		            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
		            form$.get(0).submit();
		        }
		    }
		</script>
		<script>
			<?php if(isset($_SESSION['billing'])): ?>
			$('#pills-3-tab').addClass('active');
		    $('#pills-3').addClass('show active');
		    $('#pills-1-tab').addClass('disabled');
		    $('#pills-2-tab').addClass('disabled');
			<?php else: ?>
			$('#pills-1-tab').addClass('active');
		    $('#pills-1').addClass('show active');
		    $('#pills-2-tab').addClass('disabled');
		    $('#pills-3-tab').addClass('disabled');
			<?php endif; ?>
			
		    
		    $('#s1_next').on('click',function() {

		    	$('#pills-2-tab').addClass('active');
		    	$('#pills-2').addClass('show active');

		    	$('#pills-1-tab').removeClass('active');
		    	$('#pills-1').removeClass('show active');

				$('#pills-2-tab').click();
				$('#pills-1-tab').addClass('disabled');
				$('#pills-3-tab').addClass('disabled');
			});

			$('#s2_previous').on('click',function() {

		    	$('#pills-1-tab').addClass('active');
		    	$('#pills-1').addClass('show active');

		    	$('#pills-2-tab').removeClass('active');
		    	$('#pills-2').removeClass('show active');

				$('#pills-1-tab').click();
				$('#pills-2-tab').addClass('disabled');
				$('#pills-3-tab').addClass('disabled');
			});

			$('#s2_next').on('click',function() {

		    	$('#pills-3-tab').addClass('active');
		    	$('#pills-3').addClass('show active');

		    	$('#pills-2-tab').removeClass('active');
		    	$('#pills-2').removeClass('show active');

				$('#pills-3-tab').click();
				$('#pills-1-tab').addClass('disabled');
				$('#pills-2-tab').addClass('disabled');
			});

			$('#s3_previous').on('click',function() {

		    	$('#pills-2-tab').addClass('active');
		    	$('#pills-2').addClass('show active');

		    	$('#pills-3-tab').removeClass('active');
		    	$('#pills-3').removeClass('show active');

				$('#pills-2-tab').click();
				$('#pills-1-tab').addClass('disabled');
				$('#pills-3-tab').addClass('disabled');
			});
		</script>

		<script>
        function printDiv(divName = 'printablediv') 
        {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
	    </script>
		
   </body>
</html>