<?php require_once('header.php'); ?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['slug']))
{
	header('location: '.BASE_URL);
	exit;
}
else
{
	// Check the page slug is valid or not.
	$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_slug=? AND status=?");
	$statement->execute(array($_REQUEST['slug'],'Active'));
	$total = $statement->rowCount();
	if( $total == 0 )
	{
		header('location: '.BASE_URL);
		exit;
	}
}
?>

<?php
if(isset($_POST['form_add_to_cart'])) 
{
	if(isset($_SESSION['cart_product_id']))
    {
        $arr_cart_product_id = array();
        $arr_cart_product_qty = array();

        $i=0;
        foreach($_SESSION['cart_product_id'] as $key => $value) 
        {
            $i++;
            $arr_cart_product_id[$i] = $value;
        }

        $i=0;
        foreach($_SESSION['cart_product_qty'] as $key => $value) 
        {
            $i++;
            $arr_cart_product_qty[$i] = $value;
        }

        if(in_array($_POST['product_id'],$arr_cart_product_id))
        {
           $error_message1 = 'This product is already added to the shopping cart.';
        } 
        else 
        {
            $i=0;
            foreach($_SESSION['cart_product_id'] as $key => $res) 
            {
                $i++;
            }
            $new_key = $i+1;          

            $_SESSION['cart_product_id'][$new_key] = $_POST['product_id'];
            $_SESSION['cart_product_qty'][$new_key] = $_POST['product_qty'];

            $_SESSION['success_message1'] = 'Product is added to the cart successfully!';
            
            $q = $pdo->prepare("SELECT * FROM tbl_page WHERE page_layout=?");
			$q->execute(['Product Page Layout']);
			$tot = $q->rowCount();
			$result = $q->fetchAll();
			foreach ($result as $row){
				$page_slug = $row['page_slug'];
			}
			if(!$tot) {
				header('location: '.BASE_URL);
			}
            header('location: '.BASE_URL.'page/'.$page_slug);
            exit;
        }
        
    }
    else
    {
        $_SESSION['cart_product_id'][1] = $_POST['product_id'];
        $_SESSION['cart_product_qty'][1] = $_POST['product_qty'];

        $_SESSION['success_message1'] = 'Product is added to the cart successfully!';
        $q = $pdo->prepare("SELECT * FROM tbl_page WHERE page_layout=?");
		$q->execute(['Product Page Layout']);
		$tot = $q->rowCount();
		$result = $q->fetchAll();
		foreach ($result as $row){
			$page_slug = $row['page_slug'];
		}
		if(!$tot) {
			header('location: '.BASE_URL);
		}
        header('location: '.BASE_URL.'page/'.$page_slug);
        exit;
    }
}
?>


<?php
// Getting the detailed data of a page from page slug
$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll();							
foreach ($result as $row) 
{
	$page_name    = $row['page_name'];
	$page_slug    = $row['page_slug'];
	$page_content = $row['page_content'];
	$page_layout  = $row['page_layout'];
	$banner       = $row['banner'];
	$status       = $row['status'];
}
?>

<?php 
if( (isset($error_message1)) && ($error_message1!='') ) {
	echo "<script>Swal.fire({icon: 'error',title: 'Error',html: '".$error_message1."'})</script>";
}
if(isset($_SESSION['success_message1']))
{
	echo "<script>Swal.fire({icon: 'success',title: 'Success',html: '".$_SESSION['success_message1']."'})</script>";
	unset($_SESSION['success_message1']);
}
?>

<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($banner); ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1><?php echo safe_data($page_name); ?></h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($page_name); ?></li>
		  	</ol>
		</nav>
	</div>
</div>

<?php if($page_layout == 'Full Width Page Layout'): ?>
<div class="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">				
				<?php echo safe_data($page_content); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>



<?php if($page_layout == 'Prevention Page Layout'): ?>
<div class="page-content">
	<div class="container">
		<div class="row service pt_0 pb_0">
			<?php
			// Pagination Codes
			$per_page = 10;
			$q = $pdo->prepare("SELECT * FROM tbl_prevention WHERE status=? ORDER BY prevention_order ASC");
			$q->execute(['Active']);
			$total = $q->rowCount();
			
			if($total % $per_page == 0) {$total_pages = $total / $per_page;} 
			else {$total_pages = ceil($total / $per_page);}
			
			if(!isset($_REQUEST['p'])) {$start = 1;} 
			else {$start = $per_page * ($_REQUEST['p']-1)+1;}

			$j=0; $k=0; $arr1 = array();

			$res = $q->fetchAll();
			foreach ($res as $row) {
				$j++;
				if($j>=$start) {
					$k++;
					if($k>$per_page) {break;}
					$arr1[] = $row['id'];
				}
			}
			$temp_url = BASE_URL.'page/'.$page_slug.'&p=';
			// Pagination Codes


			$q = $pdo->prepare("SELECT * FROM tbl_prevention WHERE status=? ORDER BY prevention_order ASC");
			$q->execute(['Active']);
			$res = $q->fetchAll();
			foreach ($res as $row) {
				
				// If this item is into current pagination items - Start
				if(!in_array($row['id'],$arr1)){continue;}
				// If this item is into current pagination items - End

				$prevention_detail_url = BASE_URL.'prevention/'.$row['slug'];
				?>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="service-item wow fadeInUp mb_30">
						<div class="photo">
							<a href="<?php echo safe_data($prevention_detail_url); ?>"><img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['photo']); ?>" alt=""></a>
						</div>
						<div class="text">
							<h3><a href="<?php echo safe_data($prevention_detail_url); ?>"><?php echo safe_data($row['name']); ?></a></h3>
							<?php echo safe_data($row['short_description']); ?>
							<div class="read-more">
								<a href="<?php echo safe_data($prevention_detail_url); ?>">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		
		<?php if($total_pages > 1): ?>
		<div class="row">
			<div class="col-md-12">
				<?php
				// Pagination Show
				echo '<nav class="mt_20"><ul class="pagination">';
				
				if(!isset($_REQUEST['p'])) {
					echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
				} else {
					if($_REQUEST['p'] == 1) {
						echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
					} else {
						$pr_url = $temp_url.($_REQUEST['p']-1);
						echo '<li class="page-item"><a class="page-link" href="'.$pr_url.'">Previous</a></li>';
					}
				}
					
				for($i=1;$i<=$total_pages;$i++)
				{
					if($i==1) {
						$start = 1;
					} else {
						$start = $per_page * ($i-1)+1;
					}
					$url = $temp_url.$i;
					echo '<li class="page-item">';
					echo '<a class="page-link" href="'.$url.'">'.$i.'</a>';
					echo '</li>';
				}

				if(!isset($_REQUEST['p'])) {
					$pr_url = $temp_url.'2';
					echo '<li class="page-item"><a class="page-link" href="'.$pr_url.'">Next</a></li>';
				} else {
					if($_REQUEST['p'] == $total_pages) {
						echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
					} else {
						$pr_url = $temp_url.($_REQUEST['p']+1);
						echo '<li class="page-item"><a class="page-link" href="'.$pr_url.'">Next</a></li>';
					}
				}
				echo '</ul></nav>';
				// Pagination Show
				?>
			</div>
		</div>
		<?php endif; ?>


	</div>
</div>
<?php endif; ?>



<?php if($page_layout == 'FAQ Page Layout'): ?>
<div class="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12 faq">
				<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
					<?php
					$i=0;
					$q = $pdo->prepare("SELECT * FROM tbl_faq ORDER BY faq_order ASC");
					$q->execute();
					$res = $q->fetchAll();
					foreach ($res as $row) {
						$i++;
						?>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading<?php echo safe_data($i); ?>">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse<?php echo safe_data($i); ?>" aria-expanded="false" aria-controls="collapse<?php echo safe_data($i); ?>">
										<?php echo safe_data($row['faq_title']); ?>
									</a>
								</h4>									
							</div>
							<div id="collapse<?php echo safe_data($i); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo safe_data($i); ?>">
								<div class="panel-body">
									<?php 
										echo safe_data($row['faq_content']);
									?>
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
<?php endif; ?>



<?php if($page_layout == 'Doctor Page Layout'): ?>
<div class="page-content">
	<div class="container">
		<div class="row team pt_0 pb_40">
			
			<?php
			$q = $pdo->prepare("SELECT * FROM tbl_doctor WHERE status=? ORDER BY doctor_order ASC");
			$q->execute(['Active']);
			$res = $q->fetchAll();
			foreach ($res as $row) {
				$doctor_detail_url = BASE_URL.'doctor/'.$row['slug'];
				?>
				<div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
					<div class="team-item">
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
				</div>
				<?php
			}
			
			?>
		</div>
	</div>
</div>
<?php endif; ?>



<?php if($page_layout == 'News Page Layout'): ?>
<div class="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="single-section">
					<?php

					// Pagination Codes
					$per_page = 5;
					$q = $pdo->prepare("SELECT * FROM tbl_news WHERE news_status=? ORDER BY news_order ASC");
					$q->execute(['Active']);
					$total = $q->rowCount();
					
					if($total % $per_page == 0) {$total_pages = $total / $per_page;} 
					else {$total_pages = ceil($total / $per_page);}
					
					if(!isset($_REQUEST['p'])) {$start = 1;} 
					else {$start = $per_page * ($_REQUEST['p']-1)+1;}

					$j=0; $k=0; $arr1 = array();

					$res = $q->fetchAll();
					foreach ($res as $row) {
						$j++;
						if($j>=$start) {
							$k++;
							if($k>$per_page) {break;}
							$arr1[] = $row['news_id'];
						}
					}
					$temp_url = BASE_URL.'page/'.$page_slug.'&p=';
					// Pagination Codes

					$q = $pdo->prepare("SELECT * FROM tbl_news WHERE news_status=? ORDER BY news_order ASC");
					$q->execute(['Active']);
					$res = $q->fetchAll();
					foreach ($res as $row) {

						// If this item is into current pagination items - Start
						if(!in_array($row['news_id'],$arr1)){continue;}
						// If this item is into current pagination items - End

						$news_detail_url = BASE_URL.'news/'.$row['news_slug'];
						?>
						<div class="blog-item">
							<div class="featured-photo">
								<a href="<?php echo safe_data($news_detail_url); ?>"><img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['photo']); ?>"></a>
							</div>
							<div class="text">
								<h2><a href="<?php echo safe_data($news_detail_url); ?>"><?php echo safe_data($row['news_title']); ?></a></h2>
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

				<?php if($total_pages > 1): ?>
				<div class="row">
					<div class="col-md-12">
						<?php
						// Pagination Show
						echo '<nav class="mt_20"><ul class="pagination">';
						
						if(!isset($_REQUEST['p'])) {
							echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
						} else {
							if($_REQUEST['p'] == 1) {
								echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
							} else {
								$pr_url = $temp_url.($_REQUEST['p']-1);
								echo '<li class="page-item"><a class="page-link" href="'.$pr_url.'">Previous</a></li>';
							}
						}
							
						for($i=1;$i<=$total_pages;$i++)
						{
							if($i==1) {
								$start = 1;
							} else {
								$start = $per_page * ($i-1)+1;
							}
							$url = $temp_url.$i;
							echo '<li class="page-item">';
							echo '<a class="page-link" href="'.$url.'">'.$i.'</a>';
							echo '</li>';
						}

						if(!isset($_REQUEST['p'])) {
							$pr_url = $temp_url.'2';
							echo '<li class="page-item"><a class="page-link" href="'.$pr_url.'">Next</a></li>';
						} else {
							if($_REQUEST['p'] == $total_pages) {
								echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
							} else {
								$pr_url = $temp_url.($_REQUEST['p']+1);
								echo '<li class="page-item"><a class="page-link" href="'.$pr_url.'">Next</a></li>';
							}
						}
						echo '</ul></nav>';
						// Pagination Show
						?>
					</div>
				</div>
				<?php endif; ?>

			</div>
			<div class="col-md-4">
				<?php require_once('sidebar-news.php'); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>


<?php if($page_layout == 'Contact Us Page Layout'): ?>
<?php
$q = $pdo->prepare("SELECT * FROM tbl_setting_contact WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$contact_address = $row['contact_address'];
	$contact_phone = $row['contact_phone'];
	$contact_email = $row['contact_email'];
}

if(isset($_POST['form_contact']))
{
	$valid = 1;
	$visitor_name = sanitize_string($_POST['visitor_name']);
	$visitor_email = sanitize_email($_POST['visitor_email']);
	$visitor_phone = sanitize_string($_POST['visitor_phone']);
	$visitor_message = sanitize_string($_POST['visitor_message']);
	if($visitor_name == '')
	{
		$valid = 0;
		$error_message .= 'Name can not be empty<br>';
	}
	if($visitor_email == '')
	{
		$valid = 0;
		$error_message .= 'Email can not be empty<br>';
	}
	else
	{
		if (filter_var($visitor_email, FILTER_VALIDATE_EMAIL) === false)
	    {
	        $valid = 0;
	        $error_message .= 'Email address must be valid<br>';
	    }
	}
	if($visitor_message == '')
	{
		$valid = 0;
		$error_message .= 'Message can not be empty<br>';
	}

	if($valid == 1)
	{		
		// Sending email
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

	        if($visitor_phone == '')
	        {
	        	$visitor_phone = 'Not Found';
	        }

	        $q = $pdo->prepare("SELECT * FROM tbl_email_template WHERE et_id=?");
	        $q->execute([1]);
	        $res = $q->fetchAll();
	        foreach ($res as $row) {
	        	$et_subject = $row['et_subject'];
	            $et_content = $row['et_content'];
	        }

	        $visitor_message = nl2br($visitor_message);

	        $message = str_replace('{{visitor_name}}', $visitor_name, $et_content);
			$message = str_replace('{{visitor_email}}', $visitor_email, $message);
			$message = str_replace('{{visitor_phone}}', $visitor_phone, $message);
			$message = str_replace('{{visitor_message}}', $visitor_message, $message);
	    
	    	$mail->addReplyTo($visitor_email);
		    $mail->setFrom($send_email_from);
		    $mail->addAddress($receive_email_to);
		    
		    $mail->isHTML(true);
		    $mail->Subject = $et_subject;
  
		    $mail->Body = $message;
		    $mail->send();

		    $_SESSION['success_message'] = 'You message is sent to admin successfully!';
			header('location: '.BASE_URL.'page/'.$page_slug);
			exit;

		} catch (Exception $e) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
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
<div class="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="contact-item flex">
                    <div class="contact-icon">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                    <div class="contact-text">
                        <h4>Address</h4>
                        <p>
                            <?php echo nl2br($contact_address); ?>
                        </p>
                    </div>
                </div>
			</div>
			<div class="col-md-4">
				<div class="contact-item flex">
                    <div class="contact-icon">
                        <i class="fa fa-mobile" aria-hidden="true"></i>
                    </div>
                    <div class="contact-text">
                        <h4>Phone Number</h4>
                        <p>
                           	<?php echo nl2br($contact_phone); ?>
                        </p>
                    </div>
                </div>
			</div>
			<div class="col-md-4">
				<div class="contact-item flex">
                    <div class="contact-icon">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </div>
                    <div class="contact-text">
                        <h4>Email Address</h4>
                        <p>
                            <?php echo nl2br($contact_email); ?>
                        </p>
                    </div>
                </div>
			</div>
		</div>
		<div class="row contact-form">
			<div class="col-md-12">
				<h4 class="contact-form-title mt_50 mb_20">Contact Form</h4>
				<form action="" method="post">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Name (Required)</label>
								<input type="text" class="form-control" name="visitor_name">
							</div>		
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Email Address (Required)</label>
								<input type="email" class="form-control" name="visitor_email">
							</div>		
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Phone Number</label>
								<input type="text" class="form-control" name="visitor_phone">
							</div>		
						</div>
					</div>
					<div class="form-group">
						<label>Message (Required)</label>
						<textarea name="visitor_message" class="form-control h-200" cols="30" rows="10"></textarea>
					</div>
					<button type="submit" class="btn btn-primary mt_10" name="form_contact">Send Message</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>



<?php if($page_layout == 'Photo Gallery Page Layout'): ?>
<div class="page-content mt_30">
	<div class="container">
		<div class="row">
			<?php
			$q = $pdo->prepare("SELECT * FROM tbl_photo ORDER BY photo_order ASC");
			$q->execute();
			$res = $q->fetchAll();
			foreach ($res as $row) {
				?>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="gallery-photo">
		            	<div class="gallery-photo-bg"></div>
		            	<a href="<?php echo BASE_URL.'uploads/'.$row['photo_name']; ?>" class="magnific" title="<?php echo safe_data($row['photo_caption']); ?>">
		            		<img src="<?php echo BASE_URL.'uploads/'.$row['photo_name']; ?>">
		            		<div class="plus-icon">
		            			<i class="fa fa-search-plus"></i>
		            		</div>
		            	</a>
	            	</div>
	            </div>
				<?php
			}
			?>
		</div>
	</div>
</div>
<?php endif; ?>


<?php if($page_layout == 'Video Gallery Page Layout'): ?>
<div class="page-content mt_30">
	<div class="container">
		<div class="row">
			
			<?php
			$q = $pdo->prepare("SELECT * FROM tbl_video ORDER BY video_order ASC");
			$q->execute();
			$res = $q->fetchAll();
			foreach ($res as $row) {
				?>
				<div class="col-md-6">
					<div class="video-item">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo safe_data($row['video_youtube']); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		            	<div class="video-caption">
		            		<?php echo safe_data($row['video_caption']); ?>
		            	</div>
	            	</div>
	            </div>
				<?php
			}
			?>
		</div>
	</div>
</div>
<?php endif; ?>


<?php if($page_layout == 'Product Page Layout'): ?>
<div class="page-content pt_60">
	<div class="container">
		<div class="row">
			<?php
			$q = $pdo->prepare("SELECT * FROM tbl_product WHERE product_status=? ORDER BY product_order ASC");
			$q->execute(['Active']);
			$res = $q->fetchAll();
			foreach ($res as $row) {
				$product_detail_url = BASE_URL.'product/'.$row['product_slug'];
				?>
				<div class="col-lg-3 col-md-6 col-sm-12">
					<div class="product-item">
						<div class="photo"><a href="<?php echo $product_detail_url; ?>"><img src="<?php echo BASE_URL; ?>uploads/<?php echo $row['product_featured_photo']; ?>"></a></div>
						<div class="text">
							<h3><a href="<?php echo $product_detail_url; ?>"><?php echo $row['product_name']; ?></a></h3>
							<div class="price">
								<?php if($row['product_old_price']!=''): ?>
								<del>$<?php echo $row['product_old_price']; ?></del>
								<?php endif; ?>
								$<?php echo $row['product_current_price']; ?>
							</div>
							<div class="cart-button">
								<?php if($row['product_stock'] == 0): ?>
								<a href="javascript:void;" class="stock-empty">Stock is empty</a>
								<?php else: ?>
								<form action="" method="post">
									<input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
									<input type="hidden" name="product_current_price" value="<?php echo $row['product_current_price']; ?>">
		                            <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
		                            <input type="hidden" name="product_featured_photo" value="<?php echo $row['product_featured_photo']; ?>">
		                            <input type="hidden" name="product_qty" value="1">
									<input type="submit" value="Add to Cart" name="form_add_to_cart">
								</form>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
<?php endif; ?>

<?php require_once('footer.php'); ?>