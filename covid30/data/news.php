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
	$statement = $pdo->prepare("SELECT * FROM tbl_news WHERE news_slug=?");
	$statement->execute(array($_REQUEST['slug']));
	$total = $statement->rowCount();
	if( $total == 0 )
	{
		header('location: '.BASE_URL);
		exit;
	}
}

$q = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$banner_news_detail = $row['banner_news_detail'];
}

// Getting the detailed data of a service from slug
$statement = $pdo->prepare("SELECT * FROM tbl_news WHERE news_slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll();				
foreach ($result as $row)
{
	$news_id            = $row['news_id'];
	$news_title         = $row['news_title'];
	$news_slug          = $row['news_slug'];
	$news_content       = $row['news_content'];
	$news_content_short = $row['news_content_short'];
	$news_date          = $row['news_date'];
	$photo              = $row['photo'];
	$category_id        = $row['category_id'];
	$news_order         = $row['news_order'];
	$news_status        = $row['news_status'];
	$meta_title         = $row['meta_title'];
	$meta_description   = $row['meta_description'];
}

$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_layout=?");
$statement->execute(['News Page Layout']);
$tot = $statement->rowCount();
$result = $statement->fetchAll();
foreach ($result as $row)
{
	$page_name = $row['page_name'];
	$page_slug = $row['page_slug'];
}
if(!$tot)
{
	$page_name = '';
	$page_slug = '';
}
?>

<?php
if(isset($_POST['form_comment']))
{
	$valid = 1;
	$person_name = sanitize_string($_POST['person_name']);
	$person_email = sanitize_email($_POST['person_email']);
	$person_message = sanitize_string($_POST['person_message']);
	if($person_name == '')
	{
		$valid = 0;
		$error_message .= 'Name can not be empty<br>';
	}
	if($person_email == '')
	{
		$valid = 0;
		$error_message .= 'Email can not be empty<br>';
	}
	else
	{
		if (filter_var($person_email, FILTER_VALIDATE_EMAIL) === false)
	    {
	        $valid = 0;
	        $error_message .= 'Email address must be valid<br>';
	    }
	}
	if($person_message == '')
	{
		$valid = 0;
		$error_message .= 'Comment can not be empty<br>';
	}

	if($valid == 1)
	{

		$comment_date = date('Y-m-d');
		$comment_time = date('H:i:s a');

		$q = $pdo->prepare("INSERT INTO tbl_comment (
					person_name,
					person_email,
					person_message,
					news_id,
					comment_date,
					comment_time,
					comment_status
				) 
				VALUES (?,?,?,?,?,?,?)");
		$q->execute([ 
					$person_name,
					$person_email,
					$person_message,
					$news_id,
					$comment_date,
					$comment_time,
					'Pending'
				]);

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
			$q->execute([2]);
			$res = $q->fetchAll();
			foreach ($res as $row) {
				$et_subject = $row['et_subject'];
				$et_content = $row['et_content'];
			}

			$comment_see_url = BASE_URL.'admin/comment-pending.php';

			$person_message = nl2br($person_message);

			$message = str_replace('{{person_name}}', $person_name, $et_content);
			$message = str_replace('{{person_email}}', $person_email, $message);
			$message = str_replace('{{person_message}}', $person_message, $message);
			$message = str_replace('{{comment_see_url}}', $comment_see_url, $message);

    
	    	$mail->addReplyTo($person_email);
		    $mail->setFrom($send_email_from);
		    $mail->addAddress($receive_email_to);
		    
		    $mail->isHTML(true);
		    $mail->Subject = $et_subject;
  
		    $mail->Body = $message;
		    $mail->send();

		    $_SESSION['success_message'] = 'Comment is posted successfully. It will be live after admin approval.';
			header('location: '.BASE_URL.'news/'.$news_slug);
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
<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($banner_news_detail); ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1><?php echo safe_data($news_title); ?></h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>page/<?php echo safe_data($page_slug); ?>"><?php echo safe_data($page_name); ?></a></li>
			    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($news_title); ?></li>
		  	</ol>
		</nav>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="single-section">
					<div class="featured-photo">
						<img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($photo); ?>">
					</div>
					<div class="text">
						<h2><?php echo safe_data($news_title); ?></h2>
						<h3>Posted on: <?php echo date_format_1(safe_data($news_date)); ?></h3>
						<?php echo safe_data($news_content); ?>
					</div>
					<hr class="mt_50">
					<div class="comment mt_50">

						<?php
						$total_comment = 0;
						$q = $pdo->prepare("SELECT * FROM tbl_comment WHERE comment_status=? AND news_id=? ORDER BY comment_id ASC");
						$q->execute(['Approved',$news_id]);
						$total_comment = $q->rowCount();
						?>

						<h2 class="mb_40">Comments (<?php echo safe_data($total_comment); ?>)</h2>

						<?php 
						if($total_comment == 0)
						{
							echo '<div class="text-danger">No Comment Found</div>';	
						}
						else
						{
							$i=0;
							$res = $q->fetchAll();
							foreach ($res as $row) {
								$i++;
								?>
								<div class="comment-item">
									<div class="text">
										<h4><?php echo safe_data($i).'. '; ?><?php echo safe_data($row['person_name']); ?></h4>
										<div class="date"><?php echo date_format_1(safe_data($row['comment_date'])).' at ' . safe_data($row['comment_time']); ?></div>
										<div class="des">
											<p>
												<?php echo nl2br($row['person_message']); ?>
											</p>
										</div>
									</div>
								</div>
								<?php
							}
						}
						?>

						<hr class="mt_50">

						<h2 class="mt_35">Post Your Comment</h2>
						
						<form action="" method="post">
							<div class="row mb_20">
								<div class="col">
									<input type="text" class="form-control" placeholder="Name" name="person_name">
								</div>
								<div class="col">
									<input type="email" class="form-control" placeholder="Email Address" name="person_email">
								</div>
							</div>
							<div class="row mb_20">
								<div class="col">
									<textarea name="person_message" class="form-control h-200" cols="30" rows="10" placeholder="Comment"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<button type="submit" class="btn btn-primary" name="form_comment">Post Comment</button>
								</div>
							</div>
						</form>                           

					</div>
				</div>
			</div>
			<div class="col-md-4">
				<?php require_once('sidebar-news.php'); ?>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>