<?php require_once('header.php'); ?>

<?php
if( !isset($_REQUEST['email']) || !isset($_REQUEST['token']) )
{
    header('location: '.BASE_URL);
    exit;
}

$statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE customer_email=? AND customer_token=?");
$statement->execute(array($_REQUEST['email'],$_REQUEST['token']));
$result = $statement->fetchAll();
$tot = $statement->rowCount();
if($tot == 0)
{
    header('location: '.BASE_URL);
    exit;
}

if(isset($_POST['form1']))
{
    $valid = 1;

    $new_password = sanitize_string($_POST['new_password']);
    $re_password = sanitize_string($_POST['re_password']);
    
    if( empty($new_password) || empty($re_password) )
    {
        $valid = 0;
        $error_message .= 'Please enter new and retype passwords.<br>';
    }
    else
    {
        if($new_password != $re_password)
        {
            $valid = 0;
            $error_message .= 'Passwords do not match.<br>';
        }
    }   

    if($valid == 1) 
    {
        
        $final_password = password_hash($new_password, PASSWORD_DEFAULT);

        $statement = $pdo->prepare("UPDATE tbl_customer SET customer_password=?, customer_token=? WHERE customer_email=?");
        $statement->execute([$final_password,'',$_REQUEST['email']]);
        
        header('location: '.BASE_URL.'reset-password-success');
    }
    else
    {
    	$_SESSION['error_message'] = $error_message;
    	header('location: '.BASE_URL.'reset-password?email='.$_REQUEST['email'].'&token='.$_REQUEST['token']);
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
								<label for="">New Password</label>
								<input type="password" class="form-control" name="new_password">
							</div>
							<div class="form-group">
								<label for="">Retype New Password</label>
								<input type="password" class="form-control" name="re_password">
							</div>
							<button type="submit" class="btn btn-primary" name="form1">Submit</button>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>