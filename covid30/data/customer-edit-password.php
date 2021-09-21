<?php require_once('header.php'); ?>

<?php
// Check if the customer is logged in or not
if(!isset($_SESSION['customer'])) {
    header('location: '.BASE_URL.'logout');
    exit;
} else {
    // If customer is logged in, but admin make him inactive, then force logout this user.
    $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE customer_id=? AND customer_status=?");
    $statement->execute(array($_SESSION['customer']['customer_id'],'Pending'));
    $total = $statement->rowCount();
    if($total) {
        header('location: '.BASE_URL.'logout');
        exit;
    }
}
?>

<?php
if(isset($_POST['form1']))
{
	$valid = 1;

	$customer_password = sanitize_string($_POST['customer_password']);
	$customer_re_password = sanitize_string($_POST['customer_re_password']);

	if($customer_password == '')
	{
		$valid = 0;
		$error_message .= 'Password can not be empty<br>';
	}

	if($customer_re_password == '')
	{
		$valid = 0;
		$error_message .= 'Retype Password can not be empty<br>';
	}

	if($customer_password != '' && $customer_re_password != '')
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

		$q = $pdo->prepare("UPDATE tbl_customer SET 
					customer_password=?
					WHERE customer_id=?
				");
		$q->execute([ 
					$final_password,
					$_SESSION['customer']['customer_id']
				]);

		$_SESSION['customer']['customer_password'] = $final_password;

		$_SESSION['success_message'] = 'Customer Password is updated successfully!';
		header('location: '.BASE_URL.'customer-edit-password');
		exit;
	}
	else
	{
		$_SESSION['error_message'] = $error_message;
		header('location: '.BASE_URL.'customer-edit-password');
		exit;
	}
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$banner_customer_panel = $row['banner_customer_panel'];
}
?>

<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['banner_customer_panel']); ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1>Edit Password</h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Edit Password</li>
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

<div class="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="user-sidebar">
					<?php require_once('customer-sidebar.php'); ?>
				</div>
			</div>
			<div class="col-md-9">
				
				<form action="" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Password</label>
								<input type="password" class="form-control" name="customer_password">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Retype New Password</label>
								<input type="password" class="form-control" name="customer_re_password">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary" name="form1">Update</button>
				</form>

			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>