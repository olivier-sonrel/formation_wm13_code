<?php require_once('header.php'); ?>

<!-- //essai de olivier// -->

<?php
if(isset($_POST['form_subscribe']))
{
	$valid = 1;

	$subs_email = sanitize_email($_POST['subs_email']);

	if($subs_email == '')
	{
		$valid = 0;
		$error_message .= 'Email can not be empty<br>';
	}
	else
	{
		if (filter_var($subs_email, FILTER_VALIDATE_EMAIL) === false)
	    {
	        $valid = 0;
	        $error_message .= 'Email address must be valid<br>';
	    }
	    else
	    {
	    	$statement = $pdo->prepare("SELECT * FROM tbl_subscriber WHERE subs_email=?");
	    	$statement->execute(array($subs_email));
	    	$total = $statement->rowCount();							
	    	if($total)
	    	{
	    		$valid = 0;
	        	$error_message .= 'Email address already exists<br>';
	    	}
	    }
	}

	if($valid == 1)
	{
		$subs_hash = hash('sha256',time());
		$subs_date = date('Y-m-d');
		$subs_date_time = date('Y-m-d H:i:s');

		$statement = $pdo->prepare("INSERT INTO tbl_subscriber (subs_email,subs_date,subs_date_time,subs_hash,subs_active) VALUES (?,?,?,?,?)");
		$statement->execute(array($subs_email,$subs_date,$subs_date_time,$subs_hash,0));

		// Send email to admin
		$q = $pdo->prepare("SELECT * FROM tbl_setting_email WHERE id=?");
		$q->execute([1]);
		$res = $q->fetchAll();
		foreach ($res as $row) {
			$send_email_from = $row['send_email_from'];
			$receive_email_to = $row['receive_email_to'];
			$smtp_active = $row['smtp_active'];
			$smtp_ssl = $row['smtp_ssl'];
			$smtp_host = $row['smtp_host'];
			$smtp_port = $row['smtp_port'];
			$smtp_username = $row['smtp_username'];
			$smtp_password = $row['smtp_password'];
		}

		require_once('mail/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';

        try {

			if($smtp_active == 'Yes')
		    {
		    	if($smtp_ssl == 'Yes')
		    	{
		    		$mail->SMTPSecure = "ssl";
		    	}
	            $mail->IsSMTP();
	            $mail->SMTPAuth   = true;
	            $mail->Host       = $smtp_host;
	            $mail->Port       = $smtp_port;
	            $mail->Username   = $smtp_username;
	            $mail->Password   = $smtp_password;
	        }

	        $q = $pdo->prepare("SELECT * FROM tbl_email_template WHERE et_id=?");
			$q->execute([3]);
			$res = $q->fetchAll();
			foreach ($res as $row) {
				$et_subject = $row['et_subject'];
				$et_content = $row['et_content'];
			}

	        $verification_link = BASE_URL.'verify-subscriber?email='.$subs_email.'&hash='.$subs_hash;

	        $message = str_replace('{{verification_link}}', $verification_link, $et_content);
    
	    	$mail->addReplyTo($receive_email_to);
		    $mail->setFrom($send_email_from);
		    $mail->addAddress($subs_email);
		    
		    $mail->isHTML(true);
		    $mail->Subject = $et_subject;
  
		    $mail->Body = $message;
		    $mail->send();

		    $_SESSION['success_message'] = 'An email is sent to your email address. Please check your email and follow the instruction.';
			header('location: '.BASE_URL);
			exit;

		} catch (Exception $e) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM tbl_setting_home WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$header_type                = $row['header_type'];

	$header_type_image_heading  = $row['header_type_image_heading'];
	$header_type_image_content  = $row['header_type_image_content'];
	$header_type_image_btn_text = $row['header_type_image_btn_text'];
	$header_type_image_btn_url  = $row['header_type_image_btn_url'];
	$header_type_image_photo    = $row['header_type_image_photo'];
	
	$header_type_video_heading  = $row['header_type_video_heading'];
	$header_type_video_content  = $row['header_type_video_content'];
	$header_type_video_btn_text = $row['header_type_video_btn_text'];
	$header_type_video_btn_url  = $row['header_type_video_btn_url'];
	$header_type_video_yt_url   = $row['header_type_video_yt_url'];

	$symptom_title              = $row['symptom_title'];
	$symptom_subtitle           = $row['symptom_subtitle'];
	$symptom_status             = $row['symptom_status'];

	$special_title              = $row['special_title'];
    $special_subtitle           = $row['special_subtitle'];
    $special_content            = $row['special_content'];
    $special_btn_text           = $row['special_btn_text'];
    $special_btn_url            = $row['special_btn_url'];
    $special_yt_video           = $row['special_yt_video'];
    $special_bg                 = $row['special_bg'];
    $special_video_bg           = $row['special_video_bg'];
    $special_status             = $row['special_status'];

    $prevention_title           = $row['prevention_title'];
	$prevention_subtitle        = $row['prevention_subtitle'];
	$prevention_status          = $row['prevention_status'];

	$doctor_title               = $row['doctor_title'];
    $doctor_subtitle            = $row['doctor_subtitle'];
    $doctor_status              = $row['doctor_status'];

    $appointment_title          = $row['appointment_title'];
    $appointment_text           = $row['appointment_text'];
    $appointment_btn_text       = $row['appointment_btn_text'];
    $appointment_btn_url        = $row['appointment_btn_url'];
    $appointment_bg             = $row['appointment_bg'];
    $appointment_status         = $row['appointment_status'];

    $latest_news_title          = $row['latest_news_title'];
    $latest_news_subtitle       = $row['latest_news_subtitle'];
    $latest_news_status         = $row['latest_news_status'];

    $newsletter_title           = $row['newsletter_title'];
    $newsletter_text            = $row['newsletter_text'];
    $newsletter_bg              = $row['newsletter_bg'];
    $newsletter_status          = $row['newsletter_status'];

    $outbreak_title             = $row['outbreak_title'];
    $outbreak_subtitle          = $row['outbreak_subtitle'];
    $outbreak_status            = $row['outbreak_status'];

    $outbreak_icon1             = $row['outbreak_icon1'];
    $outbreak_icon2             = $row['outbreak_icon2'];
    $outbreak_icon3             = $row['outbreak_icon3'];

    $countrywise_title          = $row['countrywise_title'];
    $countrywise_subtitle       = $row['countrywise_subtitle'];
    $countrywise_status         = $row['countrywise_status'];
}
?>

<?php 
if( (isset($error_message)) && ($error_message!='') ) {
	echo "
	<script>
	Swal.fire({
	  	icon: 'error',
	  	title: 'Error',
	  	html: '".$error_message."'
	})
	</script>
	";
}
if(isset($_SESSION['success_message'])) {
	echo "
	<script>
	Swal.fire({
	  	icon: 'success',
	  	title: 'Success',
	  	html: '".$_SESSION['success_message']."'
	})
	</script>
	";
	unset($_SESSION['success_message']);
}
?>


<?php if($header_type == 'Slider'): ?>
<div class="slider">
    <div class="slide-carousel owl-carousel">

    	<?php
    	$q = $pdo->prepare("SELECT * FROM tbl_slider WHERE status=? ORDER BY slide_order ASC");
    	$q->execute(['Active']);
    	$res = $q->fetchAll();
    	foreach ($res as $row) {
    		?>
			<div class="slider-item" style="background-image:url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['photo']); ?>);">
	            <div class="slider-bg"></div>
	            <div class="container">
	                <div class="row">
	                    <div class="col-md-7 col-sm-12">
	                        <div class="slider-table">
	                            <div class="slider-text">
	                                <div class="text-animated">
	                                    <h1><?php echo safe_data($row['heading']); ?></h1>
	                                </div>	                                
	                                <div class="text-animated">
	                                    <p>
	                                        <?php echo nl2br($row['content']); ?>
	                                    </p>
	                                </div>
	                                <div class="text-animated">
	                                    <ul>
	                                        <li><a href="<?php echo safe_data($row['button_url']); ?>"><?php echo safe_data($row['button_text']); ?></a></li>
	                                    </ul>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
    		<?php
    	}
    	?>

    </div>
</div>
<?php endif; ?>

<?php if($header_type == 'Image'): ?>
<div class="slider-single">
        
    <div class="slider-item" style="background-image:url(uploads/<?php echo safe_data($header_type_image_photo); ?>);">
        <div class="slider-bg"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="slider-table">
                        <div class="slider-text">

                            <div class="text-animated">
                                <h1><?php echo safe_data($header_type_image_heading); ?></h1>
                            </div>
                            
                            <div class="text-animated">
                                <p>
                                    <?php echo nl2br($header_type_image_content); ?>
                                </p>
                            </div>

                            <div class="text-animated">
                                <ul>
                                    <li><a href="<?php echo safe_data($header_type_image_btn_url); ?>"><?php echo safe_data($header_type_image_btn_text); ?></a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php endif; ?>


<?php if($header_type == 'Video'): ?>
<div class="slider-video pos_r">
	<div class="slider-bg-video"></div>
	<div class="slider-item-video">
		<div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="slider-table">
                        <div class="slider-text">
                            <div class="text-animated">
                                <h1><?php echo safe_data($header_type_video_heading); ?></h1>
                            </div>
                            <div class="text-animated">
                                <p>
                                    <?php echo nl2br($header_type_video_content); ?>
                                </p>
                            </div>
                            <div class="text-animated">
                                <ul>
                                    <li><a href="<?php echo safe_data($header_type_video_btn_url); ?>"><?php echo safe_data($header_type_video_btn_text); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	  	<div class="video-foreground">
	    	<iframe src="https://www.youtube.com/embed/<?php echo safe_data($header_type_video_yt_url); ?>?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&mute=1" frameborder="0" allowfullscreen></iframe>
	  	</div>
	</div>
</div>
<?php endif; ?>


<?php if($outbreak_status == 'Show'): ?>
<div class="corona-case">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading wow fadeInUp">
					<h2><?php echo safe_data($outbreak_title); ?></h2>
					<h3><?php echo safe_data($outbreak_subtitle); ?></h3>
				</div>
			</div>
		</div>
		<div class="row">
			<?php
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://covid-193.p.rapidapi.com/statistics",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => array(
					"x-rapidapi-host: covid-193.p.rapidapi.com",
					"x-rapidapi-key: a7553b5637mshc6f3f9ef27681cep13dae4jsn3ef1d5442acd"
				),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
				echo "cURL Error #:" . $err;
			} else {
				$output = json_decode($response, true);
			}
			?>

			<?php
			$total_cases = number_format($output['response']['189']['cases']['total']);
			$total_death = number_format($output['response']['189']['deaths']['total']);
			$total_recovered = number_format($output['response']['189']['cases']['recovered']);
			?>			
			<div class="col-md-4">
				<div class="corona-case-item wow fadeInUp shadow p-3 mb-5 bg-white rounded">
					<div class="icon"><img src="<?php echo BASE_URL; ?>uploads/<?php echo $outbreak_icon1; ?>" alt=""></div>
					<h4>Total Cases</h4>
					<h5><?php echo safe_data($total_cases); ?></h5>
				</div>
			</div>
			<div class="col-md-4">
				<div class="corona-case-item wow fadeInUp shadow p-3 mb-5 bg-white rounded">
					<div class="icon"><img src="<?php echo BASE_URL; ?>uploads/<?php echo $outbreak_icon2; ?>" alt=""></div>
					<h4>Total Death</h4>
					<h5><?php echo safe_data($total_death); ?></h5>
				</div>
			</div>
			<div class="col-md-4">
				<div class="corona-case-item wow fadeInUp shadow p-3 mb-5 bg-white rounded">
					<div class="icon"><img src="<?php echo BASE_URL; ?>uploads/<?php echo $outbreak_icon3; ?>" alt=""></div>
					<h4>Total Recovered</h4>
					<h5><?php echo safe_data($total_recovered); ?></h5>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>


<?php if($countrywise_status == 'Show'): ?>
<div class="countrywise">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading wow fadeInUp">
					<h2><?php echo safe_data($countrywise_title); ?></h2>
					<h3><?php echo safe_data($countrywise_subtitle); ?></h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				
				<table id="dataTable2" class="table table-bordered dt_home display nowrap w-100-p">
					<thead>
						<tr class="text-white">
							<th>Country</th>
							<th>Total Cases</th>
							<th>Active</th>
							<th>Critical</th>
							<th>Recovered</th>
							<th>New Cases</th>
							<th>Total Death</th>
							<th>New Death</th>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach($output['response'] as $val)
					{
						if($val['country'] == 'All' || 
						   $val['country'] == 'North-America' || 
						   $val['country'] == 'Asia' || 
						   $val['country'] == 'Europe' || 
						   $val['country'] == 'South-America' || 
						   $val['country'] == 'Africa' ||
						   $val['country'] == 'Ocenia') 
						{
							continue;
						}
						?>
						<tr class="c_f3f3f3">
							<td><?php echo safe_data($val['country']); ?></td>
							<td><?php echo number_format($val['cases']['total']); ?></td>
							<td><?php echo number_format($val['cases']['active']); ?></td>
							<td><?php echo number_format($val['cases']['critical']); ?></td>
							<td><?php echo number_format($val['cases']['recovered']); ?></td>
							<td><?php echo '+'.number_format($val['cases']['new']); ?></td>
							<td><?php echo number_format($val['deaths']['total']); ?></td>
							<td>
								<?php if($val['deaths']['new']!=0): ?>
								<?php echo '+'.number_format($val['deaths']['new']); ?>
								<?php endif; ?>
							</td>
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>




<?php if($symptom_status == 'Show'): ?>
<div class="feature" id="symptom" >
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading wow fadeInUp">
					<h2><?php echo safe_data($symptom_title); ?></h2>
					<h3><?php echo safe_data($symptom_subtitle); ?></h3>
				</div>
			</div>
		</div>
		<div class="row">
			<?php
			$q = $pdo->prepare("SELECT * FROM tbl_symptom WHERE status=? ORDER BY symptom_order ASC");
			$q->execute(['Active']);
			$res = $q->fetchAll();
			foreach ($res as $row) {
				?>
				<div class="col-md-4">
					<div class="feature-item wow fadeInUp">
						<div class="icon">
							<img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['photo']); ?>" alt="">
						</div>
						<h4><?php echo safe_data($row['name']); ?></h4>
						<p>
							<?php echo safe_data(nl2br($row['description'])); ?>
						</p>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
<?php endif; ?>


<?php if($special_status == 'Show'): ?>
<div class="special" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($special_bg); ?>);">
	<div class="bg"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 wow fadeInLeft">
				<h2><?php echo safe_data($special_title); ?></h2>
				<h3><?php echo safe_data($special_subtitle); ?></h3>
				<p>
					<?php echo nl2br($special_content); ?>
				</p>
				<div class="read-more">
					<a href="<?php echo safe_data($special_btn_url); ?>" class="btn btn-primary btn-arf"><?php echo safe_data($special_btn_text); ?></a>
				</div>
			</div>
			<div class="col-md-6 wow fadeInRight">
				<div class="video-section" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($special_video_bg); ?>)">
					<div class="bg video-section-bg"></div>
                    <div class="video-button-container">
                        <a class="video-button" href="https://www.youtube.com/watch?v=<?php echo safe_data($special_yt_video); ?>"><span></span></a>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>



<?php if($prevention_status == 'Show'): ?>
<div class="service">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading wow fadeInUp">
					<h2><?php echo safe_data($prevention_title); ?></h2>
					<h3><?php echo safe_data($prevention_subtitle); ?></h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="prevention-carousel owl-carousel">
					<?php
					$q = $pdo->prepare("SELECT * FROM tbl_prevention WHERE status=? ORDER BY prevention_order ASC");
					$q->execute(['Active']);
					$res = $q->fetchAll();
					foreach ($res as $row) {

						$prevention_detail_url = BASE_URL.'prevention/'.$row['slug'];

						?>
						<div class="service-item wow fadeInUp">
							<div class="photo">
								<a href="<?php echo safe_data($prevention_detail_url); ?>"><img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['photo']); ?>" alt=""></a>
							</div>
							<div class="text">
								<h3><a href="<?php echo safe_data($prevention_detail_url); ?>"><?php echo safe_data($row['name']); ?></a></h3>
								<p>
									<?php echo safe_data($row['short_description']); ?>
								</p>
								<div class="read-more">
									<a href="<?php echo safe_data($prevention_detail_url); ?>">Read More</a>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>



<?php if($doctor_status == 'Show'): ?>
<div class="team bg-lightblue">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading wow fadeInUp">
					<h2><?php echo safe_data($doctor_title); ?></h2>
					<h3><?php echo safe_data($doctor_subtitle); ?></h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="team-carousel owl-carousel">
					
					<?php
					$q = $pdo->prepare("SELECT * FROM tbl_doctor WHERE status=? ORDER BY doctor_order ASC");
					$q->execute(['Active']);
					$res = $q->fetchAll();
					foreach ($res as $row) {
						$doctor_detail_url = BASE_URL.'doctor/'.$row['slug'];
						?>
						<div class="team-item wow fadeInUp">
							<div class="team-photo">
								<a href="<?php echo safe_data($doctor_detail_url); ?>" class="team-photo-anchor">
									<img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['photo']); ?>" alt="Doctor Photo">
								</a>
							</div>
							<div class="team-text">
								<h4><a href="<?php echo safe_data($doctor_detail_url); ?>"><?php echo safe_data($row['name']); ?></a></h4>
								<p><?php echo safe_data($row['designation']); ?></p>

								<?php if($row['facebook'] != '' || $row['twitter'] != '' || $row['linkedin'] != '' || $row['youtube'] != '' || $row['instagram'] != ''): ?>
								<div class="team-social">
									<ul>
										<?php if($row['facebook'] != ''): ?>
										<li><a href="<?php echo safe_data($row['facebook']); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
										<?php endif; ?>

										<?php if($row['twitter'] != ''): ?>
										<li><a href="<?php echo safe_data($row['twitter']); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
										<?php endif; ?>

										<?php if($row['linkedin'] != ''): ?>
										<li><a href="<?php echo safe_data($row['linkedin']); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
										<?php endif; ?>

										<?php if($row['youtube'] != ''): ?>
										<li><a href="<?php echo safe_data($row['youtube']); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
										<?php endif; ?>

										<?php if($row['instagram'] != ''): ?>
										<li><a href="<?php echo safe_data($row['instagram']); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
										<?php endif; ?>
									</ul>
								</div>
								<?php endif; ?>

							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>


<?php if($appointment_status == 'Show'): ?>
<div class="cta" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($appointment_bg); ?>);">
	<div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="cta-box text-center">
                    <h2><?php echo safe_data($appointment_title); ?></h2>
                    <p class="mt-3">
                    	<?php echo nl2br($appointment_text); ?>
                    </p>
                    <a href="<?php echo safe_data($appointment_btn_url); ?>" class="btn btn-primary"><?php echo safe_data($appointment_btn_text); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php if($latest_news_status == 'Show'): ?>
<div class="blog-area">
    <div class="container wow fadeIn">
        
        <div class="row">
			<div class="col-md-12">
				<div class="heading wow fadeInUp">
					<h2><?php echo safe_data($latest_news_title); ?></h2>
					<h3><?php echo safe_data($latest_news_subtitle); ?></h3>
				</div>
			</div>
		</div>

        <div class="row">
            <div class="col-md-12">
                <div class="blog-carousel owl-carousel">                    
                    <?php
                    $q = $pdo->prepare("SELECT * FROM tbl_news WHERE news_status=? ORDER BY news_order ASC");
                    $q->execute(['Active']);
                    $res = $q->fetchAll();
                    foreach ($res as $row) {
                    	$news_detail_url = BASE_URL.'news/'.$row['news_slug'];
                    	$ts = strtotime($row['news_date']);
						$day = date('d',$ts);
						$month = date('M',$ts);
                    	?>
						<div class="blog-item wow fadeInUp">
	                        <a href="<?php echo safe_data($news_detail_url); ?>">
	                            <div class="blog-image">
	                                <img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['photo']); ?>" alt="Blog Image">
	                                <div class="date">
	                                    <h3><?php echo safe_data($day); ?></h3>
	                                    <h4><?php echo safe_data($month); ?></h4>
	                                </div>
	                            </div>
	                        </a>
	                        <div class="blog-text">
	                            <h3><a href="<?php echo safe_data($news_detail_url); ?>"><?php echo safe_data($row['news_title']); ?></a></h3>
	                            <p>
	                            	<?php echo nl2br($row['news_content_short']); ?>
	                            </p>
	                            <div class="read-more">
	                                <a href="<?php echo safe_data($news_detail_url); ?>">Read More</a>
	                            </div>
	                        </div>
	                    </div>
                    	<?php
                    }
                    ?>  
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php if($newsletter_status == 'Show'): ?>
<div class="newsletter-area" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($newsletter_bg); ?>);">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 newsletter">
				<div class="newsletter-text wow fadeInUp">
					<h2><?php echo safe_data($newsletter_title); ?></h2>
					<p>
						<?php echo nl2br($newsletter_text); ?>
					</p>
				</div>
				<div class="newsletter-button wow fadeInUp">
					<form action="" method="post" class="justify-content-center">
						<input type="text" placeholder="Enter Your Email" name="subs_email">
						<input type="submit" value="Submit" name="form_subscribe">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>


<?php require_once('footer.php'); ?>