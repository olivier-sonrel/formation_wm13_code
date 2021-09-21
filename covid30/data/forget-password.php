<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {

    $valid = 1;
        
    $customer_email = sanitize_email($_POST['customer_email']);
        
    if(empty($customer_email)) 
    {
        $valid = 0;
        $error_message .= "Email can not be empty.<br>";
    }
    else 
    {
        if (filter_var($customer_email, FILTER_VALIDATE_EMAIL) === false) 
        {
            $valid = 0;
            $error_message .= 'Email address must be valid.<br>';
        } 
        else 
        {
            $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE customer_email=?");
            $statement->execute(array($customer_email));
            $total = $statement->rowCount();                        
            if(!$total) {
                $valid = 0;
                $error_message .= 'You email address is not found in our system.<br>';
            }
        }
    }

    if($valid == 1)
    {
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
        $q->execute([7]);
        $res = $q->fetchAll();
        foreach ($res as $row) {
            $et_subject = $row['et_subject'];
            $et_content = $row['et_content'];
        }

        $token = hash('sha256',time());

        $q = $pdo->prepare("UPDATE tbl_customer SET customer_token=? WHERE customer_email=?");
        $q->execute(array($token,$customer_email));
        
        $reset_link = BASE_URL.'reset-password?email='.$customer_email.'&token='.$token;

        $message = str_replace('{{reset_link}}', $reset_link, $et_content);

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

            $_SESSION['success_message'] = 'A confirmation link is sent to your email address. You will get the password reset information in there.';
            header('location: '.BASE_URL.'forget-password');
            exit;

        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    else
    {
    	$_SESSION['error_message'] = $error_message;
        header('location: '.BASE_URL.'forget-password');
        exit;
    }
}

if(isset($_SESSION['error_message'])) {
	echo "<script>Swal.fire({icon: 'error',title: 'Error',html: '".$_SESSION['error_message']."'})</script>";
	unset($_SESSION['error_message']);
}

if(isset($_SESSION['success_message'])) {
	echo "<script>Swal.fire({icon: 'success',title: 'Success',html: '".$_SESSION['success_message']."'})</script>";
	unset($_SESSION['success_message']);
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$banner_forget_password = $row['banner_forget_password'];
}
?>

<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['banner_forget_password']); ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1>Forget Password</h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Forget Password</li>
		  	</ol>
		</nav>
	</div>
</div>

<div class="page-content pt_50 pb_60">
	<div class="container">
		<div class="row cart">

			<div class="col-md-12">				
				<div class="reg-login-form">
					<div class="inner">
						<form action="" method="post">
							<div class="form-group">
								<label for="">Email address</label>
								<input type="email" class="form-control" name="customer_email">
							</div>
							<button type="submit" class="btn btn-primary" name="form1">Submit</button>
							<div class="new-user">
								<a href="<?php echo BASE_URL; ?>login">Back to Login Page</a>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>