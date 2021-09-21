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

	$customer_name = sanitize_string($_POST['customer_name']);
	$customer_phone = sanitize_string($_POST['customer_phone']);
	$customer_country_id = sanitize_int($_POST['customer_country_id']);
	$customer_address = sanitize_string($_POST['customer_address']);
	$customer_state = sanitize_string($_POST['customer_state']);
	$customer_city = sanitize_string($_POST['customer_city']);
	$customer_zip = sanitize_string($_POST['customer_zip']);

	if($customer_name == '')
	{
		$valid = 0;
		$error_message .= 'Name can not be empty<br>';
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

	if($valid == 1)
	{
		$q = $pdo->prepare("UPDATE tbl_customer SET 
					customer_name=?, 
					customer_phone=?, 
					customer_country_id=?, 
					customer_address=?, 
					customer_state=?, 
					customer_city=?, 
					customer_zip=?		
					WHERE customer_id=?
				");
		$q->execute([ 
					$customer_name,
					$customer_phone,
					$customer_country_id,
					$customer_address,
					$customer_state,
					$customer_city,
					$customer_zip,
					$_SESSION['customer']['customer_id']
				]);

		$_SESSION['customer']['customer_name'] = $customer_name;
		$_SESSION['customer']['customer_phone'] = $customer_phone;
		$_SESSION['customer']['customer_country_id'] = $customer_country_id;
		$_SESSION['customer']['customer_address'] = $customer_address;
		$_SESSION['customer']['customer_state'] = $customer_state;
		$_SESSION['customer']['customer_city'] = $customer_city;
		$_SESSION['customer']['customer_zip'] = $customer_zip;

		$_SESSION['success_message'] = 'Customer Profile is updated successfully!';
		header('location: '.BASE_URL.'customer-edit-profile');
		exit;
	}
	else
	{
		$_SESSION['error_message'] = $error_message;
		header('location: '.BASE_URL.'customer-edit-profile');
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
		<h1>Edit Profile Information</h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Edit Profile Information</li>
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
								<label for="">Name *</label>
								<input type="text" class="form-control" value="<?php echo $_SESSION['customer']['customer_name']; ?>" name="customer_name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Email Address *</label>
								<input type="email" class="form-control" value="<?php echo $_SESSION['customer']['customer_email']; ?>" name="" disabled>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Phone *</label>
								<input type="text" class="form-control" value="<?php echo $_SESSION['customer']['customer_phone']; ?>" name="customer_phone">
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
										<option value="<?php echo $row['country_id']; ?>" <?php if($row['country_id'] == $_SESSION['customer']['customer_country_id']) {echo 'selected';} ?>><?php echo $row['country_name']; ?></option>
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
								<input type="text" class="form-control" value="<?php echo $_SESSION['customer']['customer_address']; ?>" name="customer_address">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">State *</label>
								<input type="text" class="form-control" value="<?php echo $_SESSION['customer']['customer_state']; ?>" name="customer_state">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">City *</label>
								<input type="text" class="form-control" value="<?php echo $_SESSION['customer']['customer_city']; ?>" name="customer_city">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Zip Code *</label>
								<input type="text" class="form-control" value="<?php echo $_SESSION['customer']['customer_zip']; ?>" name="customer_zip">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary" name="form1">Update Information</button>
				</form>

			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>