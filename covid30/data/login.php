<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form_login']))
{
	$valid = 1;

	$customer_email = sanitize_email($_POST['customer_email']);
    $customer_password = sanitize_string($_POST['customer_password']);

    if($customer_password == '')
    {
    	$valid = 0;
    	$error_message .= 'Password can not be empty<br>';
    }

    if($customer_email == '')
    {
    	$valid = 0;
    	$error_message .= 'Email address can not be empty<br>';
    }
    else
    {
    	if(!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
    		$valid = 0;
    		$error_message .= 'Email address is invalid<br>';
    	}
    	else
    	{
    		$q = $pdo->prepare("SELECT * FROM tbl_customer WHERE customer_email=?");
	        $q->execute(array($customer_email));
	        $total = $q->rowCount();
	        if(!$total)
	        {
	     		$valid = 0;
    			$error_message .= 'Email address is not found in our system<br>';
	        }
	        else
	        {
	        	$result = $q->fetchAll();
		        foreach($result as $row) {
		            $customer_status = $row['customer_status'];
		            $saved_password = $row['customer_password'];
		        }
		        if($customer_status!='Active')
		        {
					$valid = 0;
    				$error_message .= 'Customer is not active<br>';
		        }
		        else
		        {
		        	if(!password_verify($customer_password,$saved_password))
		        	{
		        		$valid = 0;
    					$error_message .= 'Password is wrong<br>';
		        	}
		        }
	        }
    	}
    }

    if($valid == 1)
    {
    	$_SESSION['customer'] = $row;

    	$q = $pdo->prepare("SELECT * FROM tbl_country WHERE country_id=?");
    	$q->execute([$_SESSION['customer']['customer_country_id']]);
    	$res = $q->fetchAll();
    	foreach ($res as $row) {
    		$_SESSION['customer']['customer_country'] = $row['country_name'];
    	}

    	$_SESSION['returning_customer'] = 1;
    	$_SESSION['customer_type'] = 'Returning Customer';
		header("location: ".BASE_URL."customer-dashboard");
    }
    else
    {
    	$_SESSION['error_message'] = $error_message;
    	header("location: ".BASE_URL."login");
    	exit;
    }
}


if(isset($_SESSION['error_message'])) {
	echo "<script>Swal.fire({icon: 'error',title: 'Error',html: '".$_SESSION['error_message']."'})</script>";
	unset($_SESSION['error_message']);
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$banner_login = $row['banner_login'];
}
?>

<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['banner_login']); ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1>Login</h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Login</li>
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
							<div class="form-group">
								<label for="">Password</label>
								<input type="password" class="form-control" name="customer_password">
							</div>
							<button type="submit" class="btn btn-primary" name="form_login">Login</button>
							<a href="<?php echo BASE_URL; ?>forget-password" class="btn btn-warning">Forget Password</a>
							<div class="new-user">
								<a href="<?php echo BASE_URL; ?>registration">New User? Make Registration</a>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>