<?php require_once('header.php'); ?>

<?php
if(!isset($_SESSION['cart_product_id']))
{
	header('location: '.BASE_URL);
	exit;
}
?>

<?php
// Getting total data from cart
$arr_cart_product_id = array();
$arr_cart_product_qty = array();

$i=0;
foreach($_SESSION['cart_product_id'] as $value) {
	$i++; $arr_cart_product_id[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_product_qty'] as $value) {
	$i++; $arr_cart_product_qty[$i] = $value;
}
$tot1 = 0;
for($i=1;$i<=count($arr_cart_product_id);$i++) {
	$q = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id=?");
	$q->execute([$arr_cart_product_id[$i]]);
	$res = $q->fetchAll();
	foreach ($res as $row) {
		$product_name = $row['product_name'];
		$product_slug = $row['product_slug'];
		$product_current_price = $row['product_current_price'];
		$product_featured_photo = $row['product_featured_photo'];
	}
	$subtotal = $product_current_price*$arr_cart_product_qty[$i];					
	$tot1 = $tot1+$subtotal;
	$tot1 = n_to_decimal($tot1);
}

// Getting shipping cost
$shipping_cost = $_SESSION['shipping_cost'];
$shipping_cost = n_to_decimal($shipping_cost);

$tot2 = $tot1 + $shipping_cost;
$tot2 = n_to_decimal($tot2);

// Getting coupon discount
if(isset($_SESSION['coupon_code'])) {
	$coupon_type = $_SESSION['coupon_type'];
	if($coupon_type == 'Amount') {
		$coupon_final_discount = $_SESSION['coupon_discount'];
	} else {
		$coupon_final_discount = ($tot2 * $_SESSION['coupon_discount'])/100;
	}
	$coupon_final_discount = n_to_decimal($coupon_final_discount);
} else {
	$coupon_final_discount = 0;
	$coupon_final_discount = n_to_decimal($coupon_final_discount);
}

// Getting Final Price
$tot3 = $tot2 - $coupon_final_discount;
$tot3 = n_to_decimal($tot3);
?>

<?php
$q = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$banner_checkout = $row['banner_checkout'];
}
?>

<?php
if(isset($_POST['form_guest']))
{
	$_SESSION['guest'] = 1;
	$_SESSION['customer_type'] = 'Guest';
	$_SESSION['customer_id'] = 0;
	$_SESSION['customer_name'] = sanitize_string($_POST['customer_name']);
	$_SESSION['customer_email'] = sanitize_email($_POST['customer_email']);

	header('location: '.BASE_URL.'checkout');
}

if(isset($_POST['form_clear_guest']))
{
	unset($_SESSION['guest']);
	unset($_SESSION['returning_customer']);
	unset($_SESSION['customer_type']);
	unset($_SESSION['customer_id']);
	unset($_SESSION['customer_name']);
	unset($_SESSION['customer_email']);

	unset($_SESSION['billing']);
	unset($_SESSION['billing_name']);
	unset($_SESSION['billing_email']);
	unset($_SESSION['billing_phone']);
	unset($_SESSION['billing_country']);
	unset($_SESSION['billing_address']);
	unset($_SESSION['billing_state']);
	unset($_SESSION['billing_city']);
	unset($_SESSION['billing_zip']);

	unset($_SESSION['ship_different']);
	unset($_SESSION['shipping_name']);
	unset($_SESSION['shipping_email']);
	unset($_SESSION['shipping_phone']);
	unset($_SESSION['shipping_country']);
	unset($_SESSION['shipping_address']);
	unset($_SESSION['shipping_state']);
	unset($_SESSION['shipping_city']);
	unset($_SESSION['shipping_zip']);

	header('location: '.BASE_URL.'checkout');
}

if(isset($_POST['form_clear_returning_customer']))
{
	unset($_SESSION['customer']);

	unset($_SESSION['returning_customer']);
	unset($_SESSION['customer_type']);
	unset($_SESSION['customer_id']);
	unset($_SESSION['customer_name']);
	unset($_SESSION['customer_email']);

	unset($_SESSION['billing']);
	unset($_SESSION['billing_name']);
	unset($_SESSION['billing_email']);
	unset($_SESSION['billing_phone']);
	unset($_SESSION['billing_country']);
	unset($_SESSION['billing_address']);
	unset($_SESSION['billing_state']);
	unset($_SESSION['billing_city']);
	unset($_SESSION['billing_zip']);

	unset($_SESSION['ship_different']);
	unset($_SESSION['shipping_name']);
	unset($_SESSION['shipping_email']);
	unset($_SESSION['shipping_phone']);
	unset($_SESSION['shipping_country']);
	unset($_SESSION['shipping_address']);
	unset($_SESSION['shipping_state']);
	unset($_SESSION['shipping_city']);
	unset($_SESSION['shipping_zip']);

	header('location: '.BASE_URL.'checkout');
}

if(isset($_POST['form_clear_billing_info']))
{
	unset($_SESSION['billing']);
	unset($_SESSION['billing_name']);
	unset($_SESSION['billing_email']);
	unset($_SESSION['billing_phone']);
	unset($_SESSION['billing_country']);
	unset($_SESSION['billing_address']);
	unset($_SESSION['billing_state']);
	unset($_SESSION['billing_city']);
	unset($_SESSION['billing_zip']);

	unset($_SESSION['ship_different']);
	unset($_SESSION['shipping_name']);
	unset($_SESSION['shipping_email']);
	unset($_SESSION['shipping_phone']);
	unset($_SESSION['shipping_country']);
	unset($_SESSION['shipping_address']);
	unset($_SESSION['shipping_state']);
	unset($_SESSION['shipping_city']);
	unset($_SESSION['shipping_zip']);

	header('location: '.BASE_URL.'checkout');
}

if(isset($_POST['form_billing']))
{

	$error_1 = '';
	$error_2 = '';

	$valid = 1;

	// Check the billing information
	if($_POST['billing_name'] == '')
	{
		$valid = 0;
		$error_1 .= 'Name (Billing) can not be empty<br>';
	}
	if($_POST['billing_email'] == '')
	{
		$valid = 0;
		$error_1 .= 'Email (Billing) can not be empty<br>';
	}
	if($_POST['billing_phone'] == '')
	{
		$valid = 0;
		$error_1 .= 'Phone (Billing) can not be empty<br>';
	}
	if($_POST['billing_country'] == '')
	{
		$valid = 0;
		$error_1 .= 'Country (Billing) can not be empty<br>';
	}
	if($_POST['billing_address'] == '')
	{
		$valid = 0;
		$error_1 .= 'Address (Billing) can not be empty<br>';
	}
	if($_POST['billing_state'] == '')
	{
		$valid = 0;
		$error_1 .= 'State (Billing) can not be empty<br>';
	}
	if($_POST['billing_city'] == '')
	{
		$valid = 0;
		$error_1 .= 'City (Billing) can not be empty<br>';
	}
	if($_POST['billing_zip'] == '')
	{
		$valid = 0;
		$error_1 .= 'Zip Code (Billing) can not be empty<br>';
	}

	// Check the shipping information
	if(isset($_POST['ship_different']))
	{
		if($_POST['shipping_name'] == '')
		{
			$valid = 0;
			$error_2 .= 'Name (Shipping) can not be empty<br>';
		}
		if($_POST['shipping_email'] == '')
		{
			$valid = 0;
			$error_2 .= 'Email (Shipping) can not be empty<br>';
		}
		if($_POST['shipping_phone'] == '')
		{
			$valid = 0;
			$error_2 .= 'Phone (Shipping) can not be empty<br>';
		}
		if($_POST['shipping_country'] == '')
		{
			$valid = 0;
			$error_2 .= 'Country (Shipping) can not be empty<br>';
		}
		if($_POST['shipping_address'] == '')
		{
			$valid = 0;
			$error_2 .= 'Address (Shipping) can not be empty<br>';
		}
		if($_POST['shipping_state'] == '')
		{
			$valid = 0;
			$error_2 .= 'State (Shipping) can not be empty<br>';
		}
		if($_POST['shipping_city'] == '')
		{
			$valid = 0;
			$error_2 .= 'City (Shipping) can not be empty<br>';
		}
		if($_POST['shipping_zip'] == '')
		{
			$valid = 0;
			$error_2 .= 'Zip Code (Shipping) can not be empty<br>';
		}
	}
	
	if($valid == 1)
	{
		$_SESSION['billing'] = 1;
		$_SESSION['billing_name'] = sanitize_string($_POST['billing_name']);
		$_SESSION['billing_email'] = sanitize_email($_POST['billing_email']);
		$_SESSION['billing_phone'] = sanitize_string($_POST['billing_phone']);
		$_SESSION['billing_country'] = sanitize_string($_POST['billing_country']);
		$_SESSION['billing_address'] = sanitize_string($_POST['billing_address']);
		$_SESSION['billing_state'] = sanitize_string($_POST['billing_state']);
		$_SESSION['billing_city'] = sanitize_string($_POST['billing_city']);
		$_SESSION['billing_zip'] = sanitize_string($_POST['billing_zip']);

		if(isset($_POST['ship_different']))
		{
			$_SESSION['ship_different'] = 1;
			$_SESSION['shipping_name'] = sanitize_string($_POST['shipping_name']);
			$_SESSION['shipping_email'] = sanitize_email($_POST['shipping_email']);
			$_SESSION['shipping_phone'] = sanitize_string($_POST['shipping_phone']);
			$_SESSION['shipping_country'] = sanitize_string($_POST['shipping_country']);
			$_SESSION['shipping_address'] = sanitize_string($_POST['shipping_address']);
			$_SESSION['shipping_state'] = sanitize_string($_POST['shipping_state']);
			$_SESSION['shipping_city'] = sanitize_string($_POST['shipping_city']);
			$_SESSION['shipping_zip'] = sanitize_string($_POST['shipping_zip']);	
		}
		else
		{
			$_SESSION['shipping_name'] = sanitize_string($_POST['billing_name']);
			$_SESSION['shipping_email'] = sanitize_email($_POST['billing_email']);
			$_SESSION['shipping_phone'] = sanitize_string($_POST['billing_phone']);
			$_SESSION['shipping_country'] = sanitize_string($_POST['billing_country']);
			$_SESSION['shipping_address'] = sanitize_string($_POST['billing_address']);
			$_SESSION['shipping_state'] = sanitize_string($_POST['billing_state']);
			$_SESSION['shipping_city'] = sanitize_string($_POST['billing_city']);
			$_SESSION['shipping_zip'] = sanitize_string($_POST['billing_zip']);
		}

		$_SESSION['success_billing'] = 'Billing information is added successfully!';
		header('location: '.BASE_URL.'checkout');
		exit;
	}
	else
	{
		$_SESSION['error_billing'] = $error_1.$error_2;
		header('location: '.BASE_URL.'checkout');
		exit;
	}

}



if(isset($_POST['form_returning']))
{
	$customer_email = sanitize_email($_POST['customer_email']);
    $customer_password = sanitize_string($_POST['customer_password']);

	if(empty($customer_email) || empty($customer_password)) {
        $error_message = 'Email and/or password can not be empty<br>';
    } else {
        $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE customer_email=?");
        $statement->execute(array($customer_email));
        $total = $statement->rowCount();
        $result = $statement->fetchAll();
        foreach($result as $row) {
            $customer_status = $row['customer_status'];
            $row_password = $row['customer_password'];
        }

        if($total==0) 
        {
            $error_message .= 'Email address not found<br>';
        } 
        else 
        {
            if(!password_verify($customer_password,$row_password)) 
            {
                $error_message .= 'Passwords do not match<br>';
            } 
            else 
            {
                if($customer_status == 'Pending') 
                {
                    $error_message .= 'Customer is not active yet<br>';
                } 
                else 
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
					header("location: ".BASE_URL."checkout.php");
                }
            }
        }
    }
}
?>

<?php 
if( (isset($error_message)) && ($error_message!='') ) {
	echo "<script>Swal.fire({icon: 'error',title: 'Error',html: '".$error_message."'})</script>";
}
if(isset($_SESSION['error_billing'])) {
	echo "<script>Swal.fire({icon: 'error',title: 'Error',html: '".$_SESSION['error_billing']."'})</script>";
	unset($_SESSION['error_billing']);
}
if(isset($_SESSION['success_billing'])) {
	echo "<script>Swal.fire({icon: 'success',title: 'Success',html: '".$_SESSION['success_billing']."'})</script>";
	unset($_SESSION['success_billing']);
}
?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_layout=?");
$statement->execute(['Product Page Layout']);
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

<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo $banner_checkout; ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1>Checkout</h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>page/<?php echo safe_data($page_slug); ?>"><?php echo safe_data($page_name); ?></a></li>
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>cart">Cart</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
		  	</ol>
		</nav>
	</div>
</div>

<div class="page-content pt_50 pb_60 page-content-checkout">
	<div class="container">
		<div class="row cart">


			<div class="col-md-8">				
				<div class="checkout">
					<div class="checkout-billing">
						<div class="row">
							<div class="col-md-12">
								
								<ul class="nav nav-pills mb-3 checkout-tab" id="pills-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true"><i class="fa fa-user"></i> User</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false"><i class="fa fa-address-card"></i> Address</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false"><i class="fa fa-shopping-cart"></i> Checkout</a>
									</li>
								</ul>


								<div class="tab-content" id="pills-tabContent">
									
									<div class="tab-pane fade" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
										
										<!-- Content of tab 1 start -->
										<?php if(isset($_SESSION['returning_customer'])): ?>
										<h2>Returning Customer</h2>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" value="<?php echo $_SESSION['customer']['customer_name']; ?>" disabled>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" value="<?php echo $_SESSION['customer']['customer_email']; ?>" disabled>
												</div>
											</div>
										</div>
										<form action="" method="post">
										<button type="submit" class="btn btn-warning btn-block" name="form_clear_returning_customer">Remove Returning Customer</button>
										</form>
										<?php endif; ?>

										<?php if(!isset($_SESSION['returning_customer'])): ?>
										<div class="row">
											<div class="col-md-6">
												<h2>Checkout as Guest</h2>
												<?php
												if(isset($_SESSION['customer_type']))
												{
													if($_SESSION['customer_type'] == 'Guest')
													{
														$customer_name = $_SESSION['customer_name'];
														$customer_email = $_SESSION['customer_email'];
													}
												}
												else
												{
													$customer_name = '';
													$customer_email = '';
												}
												?>
												<form action="" method="post">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Full Name" name="customer_name" value="<?php echo $customer_name; ?>" required>
												</div>
												<div class="form-group">
													<input type="email" class="form-control" placeholder="Email Address" name="customer_email" value="<?php echo $customer_email; ?>" required>
												</div>

												<?php if(!isset($_SESSION['guest'])): ?>
												<button type="submit" class="btn btn-primary btn-block" name="form_guest">Continue as Guest</button>
												<?php endif; ?>
												</form>

												<form action="" method="post">
												<?php if(isset($_SESSION['guest'])): ?>
												<button type="submit" class="btn btn-warning btn-block" name="form_clear_guest">Remove Guest</button>
												<?php endif; ?>
												</form>

											</div>

											<?php if(!isset($_SESSION['guest'])): ?>
											<div class="col-md-6">
												<h2>Checkout as Existing User</h2>
												<form action="" method="post">
												<div class="form-group">
													<input type="email" name="customer_email" class="form-control" placeholder="Email Address" required>
												</div>
												<div class="form-group">
													<input type="password" name="customer_password" class="form-control" placeholder="Password" required>
												</div>
												<button type="submit" class="btn btn-primary btn-block" name="form_returning">Login</button>
												</form>
											</div>
											<?php endif; ?>
										</div>
										<?php endif; ?>

										
										<div class="row">
											<div class="col-md-12 mt_60 xs_mt_0">
												<?php if( isset($_SESSION['guest']) || isset($_SESSION['returning_customer']) ): ?>
												<a id="s1_next" class="btn btn-info text-white">Next Page</a>
												<?php else: ?>
												<a href="javascript:void;" class="btn btn-info">Next Page</a>
												<?php endif; ?>
											</div>
										</div>
										

										<!-- Content of tab 1 end -->

									</div>


									<div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
										<!-- Content of tab 2 start -->
										<h2>Billing Information</h2>
										<form action="" method="post">
										<div class="row">
											<?php
											$billing_name = '';
											if(isset($_SESSION['billing_name'])) {
												$billing_name = $_SESSION['billing_name'];
											} else {
												if(isset($_SESSION['customer'])) {
													$billing_name = $_SESSION['customer']['customer_name'];
												}
											}

											$billing_email = '';
											if(isset($_SESSION['billing_email'])) {
												$billing_email = $_SESSION['billing_email'];
											} else {
												if(isset($_SESSION['customer'])) {
													$billing_email = $_SESSION['customer']['customer_email'];
												}
											}

											$billing_phone = '';
											if(isset($_SESSION['billing_phone'])) {
												$billing_phone = $_SESSION['billing_phone'];
											} else {
												if(isset($_SESSION['customer'])) {
													$billing_phone = $_SESSION['customer']['customer_phone'];
												}
											}

											$billing_country = '';
											if(isset($_SESSION['billing_country'])) {
												$billing_country = $_SESSION['billing_country'];
											} else {
												if(isset($_SESSION['customer'])) {

													$billing_country = $_SESSION['customer']['customer_country'];
												}
											}

											$billing_address = '';
											if(isset($_SESSION['billing_address'])) {
												$billing_address = $_SESSION['billing_address'];
											} else {
												if(isset($_SESSION['customer'])) {
													$billing_address = $_SESSION['customer']['customer_address'];
												}
											}

											$billing_state = '';
											if(isset($_SESSION['billing_state'])) {
												$billing_state = $_SESSION['billing_state'];
											} else {
												if(isset($_SESSION['customer'])) {
													$billing_state = $_SESSION['customer']['customer_state'];
												}
											}

											$billing_city = '';
											if(isset($_SESSION['billing_city'])) {
												$billing_city = $_SESSION['billing_city'];
											} else {
												if(isset($_SESSION['customer'])) {
													$billing_city = $_SESSION['customer']['customer_city'];
												}
											}

											$billing_zip = '';
											if(isset($_SESSION['billing_zip'])) {
												$billing_zip = $_SESSION['billing_zip'];
											} else {
												if(isset($_SESSION['customer'])) {
													$billing_zip = $_SESSION['customer']['customer_zip'];
												}
											}
											?>
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Full Name" name="billing_name" value="<?php echo $billing_name; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="email" class="form-control" placeholder="Email Address" name="billing_email" value="<?php echo $billing_email; ?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Phone Number" name="billing_phone" value="<?php echo $billing_phone; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<select name="billing_country" class="form-control">
														<option value="">Select Country</option>
														<?php
														$q = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_name ASC");
														$q->execute();
														$res = $q->fetchAll();
														foreach ($res as $row) {
															?><option value="<?php echo $row['country_name']; ?>" <?php if($billing_country==$row['country_name']) {echo 'selected';} ?>><?php echo $row['country_name']; ?></option><?php
														}
														?>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Address" name="billing_address" value="<?php echo $billing_address; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="State" name="billing_state" value="<?php echo $billing_state; ?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="City" name="billing_city" value="<?php echo $billing_city; ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" placeholder="Zip Code" name="billing_zip" value="<?php echo $billing_zip; ?>">
												</div>
											</div>
										</div>

										<div class="mb_20">
											<div class="custom-control custom-checkbox">
											  	<input type="checkbox" class="custom-control-input" id="checkShipping" name="ship_different" value="1" <?php if(isset($_SESSION['ship_different'])) {echo 'checked';} ?>>
											  	<label class="custom-control-label" for="checkShipping">Ship to a different location?</label>
											</div>
										</div>

										<div class="shipping-form" style="display:none;<?php if(isset($_SESSION['ship_different'])) {echo 'display: block;';} ?>">
											<h2>Shipping Information</h2>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="Full Name" name="shipping_name" value="<?php if(isset($_SESSION['shipping_name'])) {echo $_SESSION['shipping_name'];} ?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<input type="email" class="form-control" placeholder="Email Address" name="shipping_email" value="<?php if(isset($_SESSION['shipping_email'])) {echo $_SESSION['shipping_email'];} ?>">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="Phone Number" name="shipping_phone" value="<?php if(isset($_SESSION['shipping_phone'])) {echo $_SESSION['shipping_phone'];} ?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<select name="shipping_country" class="form-control">
															<option value="">Select Country</option>
															<?php
															$q = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_name ASC");
															$q->execute();
															$res = $q->fetchAll();
															foreach ($res as $row) {
																if(isset($_SESSION['shipping_country'])) {
																	?><option value="<?php echo $row['country_name']; ?>" <?php if($_SESSION['shipping_country']==$row['country_name']) {echo 'selected';} ?>><?php echo $row['country_name']; ?></option><?php
																}
																else
																{
																	?><option value="<?php echo $row['country_name']; ?>"><?php echo $row['country_name']; ?></option><?php
																}
															}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="Address" name="shipping_address" value="<?php if(isset($_SESSION['shipping_address'])) {echo $_SESSION['shipping_address'];} ?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="State" name="shipping_state" value="<?php if(isset($_SESSION['shipping_state'])) {echo $_SESSION['shipping_state'];} ?>">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="City" name="shipping_city" value="<?php if(isset($_SESSION['shipping_city'])) {echo $_SESSION['shipping_city'];} ?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="Zip Code" name="shipping_zip" value="<?php if(isset($_SESSION['shipping_zip'])) {echo $_SESSION['shipping_zip'];} ?>">
													</div>
												</div>
											</div>
										</div>

										<?php if(!isset($_SESSION['billing'])): ?>
										<button type="submit" class="btn btn-primary btn-block" name="form_billing">Save the Billing Info</button>
										<?php endif; ?>
										</form>

										<?php if(isset($_SESSION['billing'])): ?>
										<form action="" method="post">
										<button type="submit" class="btn btn-warning btn-block" name="form_clear_billing_info">Remove Billing Information</button>
										</form>
										<?php endif; ?>

										<div class="row">
											<div class="col-md-12 mt_60 xs_mt_0">

												<a id="s2_previous" class="btn btn-info text-white">Previous Page</a>

												<?php if(isset($_SESSION['billing'])): ?>
												<a id="s2_next" class="btn btn-info text-white">Next Page</a>
												<?php else: ?>
												<a href="javascript:void;" class="btn btn-info">Next Page</a>
												<?php endif; ?>

											</div>
										</div>
										<!-- Content of tab 2 end -->
									</div>


									<div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
										<!-- Content of tab 3 start -->
										<h2>Complete Payment</h2>
										<div class="form-group">
											<select name="" class="form-control" id="paymentMethodChange">
												<option value="">Select a Payment Method</option>
												<option value="PayPal">PayPal</option>
												<option value="Stripe">Stripe</option>
											</select>
										</div>
										<div class="paypal">
											<form class="paypal" action="<?php echo BASE_URL; ?>payment/paypal/payment_process.php" method="post" id="paypal_form">
											<input type="hidden" name="amount" value="<?php echo $tot3; ?>">
											<input type="hidden" name="cmd" value="_xclick" />
							                <input type="hidden" name="no_note" value="1" />
							                <input type="hidden" name="lc" value="UK" />
							                <input type="hidden" name="currency_code" value="USD" />
							                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
											<button type="submit" class="btn btn-primary btn-block">Pay Now</button>
											</form>
										</div>
										<div class="stripe">
											<form action="<?php echo BASE_URL; ?>payment/stripe/init.php" method="post" id="stripe_form">
											<input type="hidden" name="payment" value="posted">
                                    		<input type="hidden" name="amount" value="<?php echo $tot3; ?>">
											<div class="form-group">
												<label for="">Card Number</label>
												<input type="text" name="card_number" class="form-control card-number" required>
											</div>
											<div class="form-group">
												<label for="">Card CVV</label>
												<input type="text" name="card_cvv" class="form-control card-cvc" required>
											</div>
											<div class="form-group">
												<label for="">Expire Month</label>
												<input type="text" name="card_expiry_month" class="form-control card-expiry-month" required>
											</div>
											<div class="form-group">
												<label for="">Expire Year</label>
												<input type="text" name="card_expiry_year" class="form-control card-expiry-year" required>
											</div>
											<button type="submit" class="btn btn-primary btn-block" id="submit-button" name="form_stripe">Pay Now</button>
											<div id="msg-container"></div>
											</form>
										</div>
										<div class="row">
											<div class="col-md-12 mt_60 xs_mt_0">
												<?php if( isset($_SESSION['guest']) || isset($_SESSION['returning_customer']) ): ?>
												<a id="s3_previous" class="btn btn-info text-white">Previous Page</a>
												<?php else: ?>
												<a href="javascript:void;" class="btn btn-info">Previous Page</a>
												<?php endif; ?>
											</div>
										</div>

										<!-- Content of tab 3 end -->
									</div>


								</div>
								<!-- End of "tab-content" -->
								
							</div>
							<!-- End of "col-md-12" -->

						</div>
					</div>

				</div>
			</div>

			<div class="col-md-4 order-summery-area">
				<h3>Order Summery</h3>
				
				<div class="table-responsive">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>Total Product Price</td>
								<td class="text-right">
									<?php
										echo '$'.$tot1;
									?>
								</td>
							</tr>
							<tr>
								<td>Shipping Cost</td>
								<td class="text-right">
								<?php 
									echo '+$'.$shipping_cost;
								?>
								</td>
							</tr>
							<tr>
								<td>
									Coupon Discount
									<?php if($_SESSION['coupon_code']!=''): ?>
									<div class="font-weight-bold">
										(<?php echo $_SESSION['coupon_code']; ?>)
									</div>
									<?php endif; ?>
								</td>
								<td class="text-right">
								<?php
									echo '-$'.$coupon_final_discount;
								?>
								</td>
							</tr>
							<tr class="table-warning">
								<td class="font-weight-bold">Total Price</td>
								<td class="text-right font-weight-bold">
									<?php
										echo '$'.$tot3;
									?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>



			<div class="col-md-12">
				
			</div>

		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>