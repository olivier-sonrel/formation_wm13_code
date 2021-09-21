<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form_registration']))
{
	$valid = 1;

	$customer_name = sanitize_string($_POST['customer_name']);
	$customer_email = sanitize_email($_POST['customer_email']);
	$customer_phone = sanitize_string($_POST['customer_phone']);
	$customer_country_id = sanitize_int($_POST['customer_country_id']);
	$customer_address = sanitize_string($_POST['customer_address']);
	$customer_state = sanitize_string($_POST['customer_state']);
	$customer_city = sanitize_string($_POST['customer_city']);
	$customer_zip = sanitize_string($_POST['customer_zip']);
	$customer_password = sanitize_string($_POST['customer_password']);
	$customer_re_password = sanitize_string($_POST['customer_re_password']);

	if($customer_name == '')
	{
		$valid = 0;
		$error_message .= 'Name can not be empty<br>';
	}

	if($customer_email == '')
	{
		$valid = 0;
		$error_message .= 'Email address can not be empty<br>';
	}
	else
	{
		if(!filter_var($customer_email,FILTER_VALIDATE_EMAIL))
		{
			$valid = 0;
			$error_message .= 'Email address is invalid<br>';
		}
		else
		{
			$q = $pdo->prepare("SELECT * FROM tbl_customer WHERE customer_email=?");
			$q->execute([$customer_email]);
			$tot = $q->rowCount();
			if($tot)
			{
				$valid = 0;
				$error_message .= 'Email address already exists<br>';
			}
		}
	}

	if($customer_phone == '')
	{
		$valid = 0;
		$error_message .= 'Phone can not be empty<br>';
	}

	if($customer_country_id == '')
	{
		$valid = 0;
		$error_message .= 'You must have to select a country<br>';
	}

	if($customer_address == '')
	{
		$valid = 0;
		$error_message .= 'Address can not be empty<br>';
	}

	if($customer_state == '')
	{
		$valid = 0;
		$error_message .= 'State can not be empty<br>';
	}

	if($customer_city == '')
	{
		$valid = 0;
		$error_message .= 'City can not be empty<br>';
	}

	if($customer_zip == '')
	{
		$valid = 0;
		$error_message .= 'Zip Code can not be empty<br>';
	}

	if($customer_password == '' || $customer_re_password == '')
	{
		$valid = 0;
		$error_message .= 'Password can not be empty<br>';
	}
	else
	{
		if($customer_password != $customer_re_password)
		{
			$valid = 0;
			$error_message .= 'Passwords do not match<br>';	
		}
	}	

	if($valid == 1)
	{
		$final_password = password_hash($customer_password, PASSWORD_DEFAULT);
		$token = hash('sha256',time());

		$q = $pdo->prepare("INSERT INTO tbl_customer (
					customer_name,
					customer_email,
					customer_phone,
					customer_country_id,
					customer_address,
					customer_state,
					customer_city,
					customer_zip,
					customer_password,
					customer_token,
					customer_status
				) 
				VALUES (?,?,?,?,?,?,?,?,?,?,?)");
		$q->execute([ 
					$customer_name,
					$customer_email,
					$customer_phone,
					$customer_country_id,
					$customer_address,
					$customer_state,
					$customer_city,
					$customer_zip,
					$final_password,
					$token,
					'Pending'
				]);

		$q = $pdo->prepare("SELECT * FROM tbl_setting_email WHERE id=1");
        $q->execute();
        $result = $q->fetchAll();
        foreach ($result as $row) {
            $send_email_from = $row['send_email_from'];
            $receive_email_to = $row['receive_email_to'];
            $smtp_active = $row['smtp_active'];
            $smtp_ssl = $row['smtp_ssl'];
            $smtp_host = $row['smtp_host'];
            $smtp_port = $row['smtp_port'];
            $smtp_username = $row['smtp_username'];
            $smtp_password = $row['smtp_password'];
        }

        $q = $pdo->prepare("SELECT * FROM tbl_email_template WHERE et_id=?");
        $q->execute([6]);
        $res = $q->fetchAll();
        foreach ($res as $row) {
            $et_subject = $row['et_subject'];
            $et_content = $row['et_content'];
        }

        $verification_link = BASE_URL.'verify-registration?email='.$customer_email.'&token='.$token;
        $message = str_replace('{{verification_link}}', $verification_link, $et_content);

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
                $mail->SMTPAuth = true;
                $mail->Host     = $smtp_host;
                $mail->Port     = $smtp_port;
                $mail->Username = $smtp_username;
                $mail->Password = $smtp_password;
            }
        
            $mail->addReplyTo($receive_email_to);
            $mail->setFrom($send_email_from);
            $mail->addAddress($customer_email);
            
            $mail->isHTML(true);
            $mail->Subject = $et_subject;
  
            $mail->Body = $message;
            $mail->send();

            $_SESSION['success_message'] = 'Please check your email to verify your registration. Check your spam folder too.';
			header('location: '.BASE_URL.'registration');
			exit;

        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
	
	}
	else
	{
		$_SESSION['error_message'] = $error_message;
		header('location: '.BASE_URL.'registration');
		exit;
	}
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$banner_registration = $row['banner_registration'];
}
?>

<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['banner_registration']); ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1>Registration</h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Registration</li>
		  	</ol>
		</nav>
	</div>
</div>

<?php
if(isset($_SESSION['error_message'])) {
	echo "<script>Swal.fire({icon: 'error',title: 'error',html: '".$_SESSION['error_message']."'})</script>";
	unset($_SESSION['error_message']);
}
if(isset($_SESSION['success_message'])) {
	echo "<script>Swal.fire({icon: 'success',title: 'Success',html: '".$_SESSION['success_message']."'})</script>";
	unset($_SESSION['success_message']);
}
?>

<div class="page-content pt_50 pb_60">
	<div class="container">
		<div class="row cart">

			<div class="col-md-12">				
				<div class="reg-login-form">
					<div class="inner">
						<form action="" method="post">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Name *</label>
										<input type="text" class="form-control" value="" name="customer_name">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Email Address *</label>
										<input type="text" class="form-control" value="" name="customer_email">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Phone *</label>
										<input type="text" class="form-control" value="" name="customer_phone">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Country *</label>
										<select name="customer_country_id" class="form-control select2">
											<?php
											$q = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_id ASC");
											$q->execute();
											$res = $q->fetchAll();
											foreach ($res as $row) {
												?>
												<option value="<?php echo $row['country_id']; ?>"><?php echo $row['country_name']; ?></option>
												<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Address *</label>
										<input type="text" class="form-control" value="" name="customer_address">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">State *</label>
										<input type="text" class="form-control" value="" name="customer_state">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">City *</label>
										<input type="text" class="form-control" value="" name="customer_city">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Zip Code *</label>
										<input type="text" class="form-control" value="" name="customer_zip">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Password *</label>
										<input type="password" class="form-control" value="" name="customer_password">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Retype Password *</label>
										<input type="password" class="form-control" value="" name="customer_re_password">
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary" name="form_registration">Sign Up</button>
							<div class="new-user">
								<a href="<?php echo BASE_URL; ?>login">Existing User? Go to Login Page</a>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>