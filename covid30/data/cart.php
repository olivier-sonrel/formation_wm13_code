<?php require_once('header.php'); ?>

<?php
if(!isset($_SESSION['shipping_cost']))
{
	$_SESSION['shipping_cost'] = 0;
}
if(!isset($_SESSION['coupon_id']))
{
	$_SESSION['coupon_id'] = 0;
	$_SESSION['coupon_code'] = '';
	$_SESSION['coupon_type'] = '';
	$_SESSION['coupon_discount'] = 0;
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$banner_cart = $row['banner_cart'];
}
?>

<?php
if(isset($_POST['form1'])) 
{
    $i = 0;
    $q = $pdo->prepare("SELECT * FROM tbl_product");
    $q->execute();
    $result = $q->fetchAll();
    foreach ($result as $row) {
        $i++;
        $table_product_id[$i] = $row['product_id'];
        $table_product_stock[$i] = $row['product_stock'];
    }

    $arr1 = array();
    $arr2 = array();
    $arr3 = array();

    $i=0;
    foreach($_POST['product_id'] as $val) {
        $i++;
        $arr1[$i] = $val;
    }
    $i=0;
    foreach($_POST['product_qty'] as $val) {
        $i++;
        $arr2[$i] = $val;
    }
    $i=0;
    foreach($_POST['product_name'] as $val) {
        $i++;
        $arr3[$i] = $val;
    }
    
    $allow_update = 1;
    for($i=1;$i<=count($arr1);$i++) 
    {
        for($j=1;$j<=count($table_product_id);$j++) 
        {
            if($arr1[$i] == $table_product_id[$j]) 
            {
                $temp_index = $j;
                break;
            }
        }
        if($table_product_stock[$temp_index] < $arr2[$i]) 
        {
        	$allow_update = 0;
            $error_message .= '"'.$arr2[$i].'" items are not available for "'.$arr3[$i].'"\n';
        } 
        else 
        {
            $_SESSION['cart_product_qty'][$i] = $arr2[$i];
        }
    }
    
    
    if($allow_update == 0) 
    {
    	echo "<script>Swal.fire({icon: 'error',title: 'Error',html: '".$error_message."'})</script>";
    }
    else
    {
    	echo "<script>Swal.fire({icon: 'success',title: 'Success',html: 'All Items Quantity Update is Successful!'})</script>";
    }
}


if(isset($_POST['form_shipping_apply']))
{
	$_SESSION['shipping_id'] = sanitize_int($_POST['shipping_id']);

	$q = $pdo->prepare("SELECT * FROM tbl_shipping WHERE shipping_id=?");
	$q->execute([$_POST['shipping_id']]);
	$res = $q->fetchAll();
	foreach ($res as $row) {
		$_SESSION['shipping_cost'] = n_to_decimal($row['shipping_cost']);
	}

	header('location: '.BASE_URL.'cart');
	exit;
}

if(isset($_POST['form_coupon_apply']))
{
	$coupon_code = sanitize_string($_POST['coupon_code']);

	$q = $pdo->prepare("SELECT * FROM tbl_coupon WHERE coupon_code=?");
	$q->execute([$coupon_code]);
	$tot = $q->rowCount();
	if(!$tot)
	{
		$_SESSION['error_message2'] = 'Invalid Coupon code!';
	}
	else
	{
		$res = $q->fetchAll();
		foreach ($res as $row) 
		{
			$coupon_id = $row['coupon_id'];
			$coupon_type = $row['coupon_type'];
			$coupon_discount = $row['coupon_discount'];
			$coupon_maximum_use = $row['coupon_maximum_use'];
			$coupon_existing_use = $row['coupon_existing_use'];
			$coupon_start_date = $row['coupon_start_date'];
			$coupon_end_date = $row['coupon_end_date'];

			if($coupon_maximum_use == $coupon_existing_use)
			{
				$_SESSION['error_message2'] = 'Coupon code used maximum times!';
			}
			else
			{
				$today_time = strtotime(date('Y-m-d'));
				if( $today_time < strtotime($coupon_start_date) )
				{
					$_SESSION['error_message2'] = 'Coupon date do not come yet!';
				}
				elseif( $today_time > strtotime($coupon_end_date) )
				{
					$_SESSION['error_message2'] = 'Coupon date is expired!';
				}
				else
				{
					$_SESSION['coupon_id'] = $coupon_id;
					$_SESSION['coupon_code'] = $coupon_code;
					$_SESSION['coupon_type'] = $coupon_type;
					$_SESSION['coupon_discount'] = $coupon_discount;
					$_SESSION['success_message2'] = 'Coupon code is applied successfully!';
				}
			}
		}
	}

	header('location: '.BASE_URL.'cart');
	exit;
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

<?php
if(isset($_SESSION['error_message2']))
{
	echo "<script>Swal.fire({icon: 'error',title: 'error',html: '".$_SESSION['error_message2']."'})</script>";
	unset($_SESSION['error_message2']);
}
if(isset($_SESSION['success_message2']))
{
	echo "<script>Swal.fire({icon: 'success',title: 'Success',html: '".$_SESSION['success_message2']."'})</script>";
	unset($_SESSION['success_message2']);
}

if(isset($_SESSION['cart_delete_message']))
{
	echo "<script>Swal.fire({icon: 'success',title: 'Success',html: '".$_SESSION['cart_delete_message']."'})</script>";
	unset($_SESSION['cart_delete_message']);
}
?>

<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo $banner_cart; ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1>Cart</h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>page/<?php echo safe_data($page_slug); ?>"><?php echo safe_data($page_name); ?></a></li>
			    <li class="breadcrumb-item active" aria-current="page">Cart</li>
		  	</ol>
		</nav>
	</div>
</div>

<div class="page-content pt_50 pb_60">
	<div class="container">
		<div class="row cart">
			<div class="col-md-8">				
				<?php if(!isset($_SESSION['cart_product_id'])): ?>
				Cart is empty!
				<?php else: ?>
				<form action="" method="post">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr class="table-info">
								<th>Serial</th>
								<th>Thumbnail</th>
								<th>Product Name</th>
								<th>Unit Price</th>
								<th>Quantity</th>
								<th>Subtotal</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$arr_cart_product_id = array();
							$arr_cart_product_qty = array();

							$i=0;
							foreach($_SESSION['cart_product_id'] as $value)
							{
								$i++;
								$arr_cart_product_id[$i] = $value;
							}

							$i=0;
							foreach($_SESSION['cart_product_qty'] as $value)
							{
								$i++;
								$arr_cart_product_qty[$i] = $value;
							}

							$tot1 = 0;
							for($i=1;$i<=count($arr_cart_product_id);$i++)
							{
								$q = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id=?");
								$q->execute([$arr_cart_product_id[$i]]);
								$res = $q->fetchAll();
								foreach ($res as $row) {
									$product_name = $row['product_name'];
									$product_slug = $row['product_slug'];
									$product_current_price = $row['product_current_price'];
									$product_featured_photo = $row['product_featured_photo'];
								}
								?>
								<input type="hidden" name="product_id[]" value="<?php echo $arr_cart_product_id[$i]; ?>">
								<input type="hidden" name="product_name[]" value="<?php echo $product_name; ?>">
								<tr>
									<td><?php echo $i; ?></td>
									<td class="align-middle"><img src="<?php echo BASE_URL; ?>uploads/<?php echo $product_featured_photo; ?>"></td>
									<td class="align-middle">
										<a href="<?php echo BASE_URL; ?>product/<?php echo $product_slug; ?>"><?php echo $product_name; ?></a>
									</td>
									<td class="align-middle">$<?php echo $product_current_price; ?></td>
									<td class="align-middle">
										<input type="number" class="form-control" name="product_qty[]" step="1" min="1" max="" pattern="" pattern="[0-9]*" inputmode="numeric" value="<?php echo $arr_cart_product_qty[$i]; ?>">
									</td>
									<td class="align-middle">
										<?php $subtotal = $product_current_price*$arr_cart_product_qty[$i]; ?>
										$<?php echo $subtotal; ?>
									</td>
									<td class="align-middle">
										<a href="cart-item-delete.php?id=<?php echo $arr_cart_product_id[$i]; ?>" class="btn btn-xs btn-danger" onClick="return confirm('Are you sure to delete this item from the cart?');"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<?php
								$tot1 = $tot1+$subtotal;
							}
							?>
						</tbody>
					</table>
				</div>
				<div class="cart-buttons">
					<input type="submit" value="Update Cart" class="btn btn-info btn-arf" name="form1">
				</div>
				</form>
				<?php endif; ?>


			</div>

			<div class="col-md-4">


				<?php if(isset($_SESSION['cart_product_id'])): ?>
				<h3>Order Summery</h3>
				<div class="table-responsive">
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td>Total Product Price</td>
								<td class="text-right">
									<?php
										$tot1 = n_to_decimal($tot1);
										echo '$'.$tot1;
									?>
								</td>
							</tr>
							<tr>
								<td>Shipping Cost</td>
								<td class="text-right">
								<?php
								echo '+$'.n_to_decimal($_SESSION['shipping_cost']);
								?>
								</td>
							</tr>
							<tr>
								<td>
									<?php $tot2 = $tot1 + $_SESSION['shipping_cost']; ?>
									Coupon Discount
									<?php if($_SESSION['coupon_code']!=''): ?>
									<div class="font-weight-bold">
										(<?php echo $_SESSION['coupon_code']; ?>)
									</div>
									<?php endif; ?>
								</td>
								<td class="text-right">
								<?php
								if($_SESSION['coupon_code']!='')
								{
									$coupon_type = $_SESSION['coupon_type'];
									if($coupon_type == 'Amount')
									{
										$coupon_final_discount = $_SESSION['coupon_discount'];
									}
									else
									{
										$coupon_final_discount = ($tot2 * $_SESSION['coupon_discount'])/100;
									}
									$coupon_final_discount = n_to_decimal($coupon_final_discount);
								}
								else
								{
									$coupon_final_discount = 0;
									$coupon_final_discount = n_to_decimal($coupon_final_discount);
								}

								echo '-$'.$coupon_final_discount;
								?>
								</td>
							</tr>
							<tr class="table-warning">
								<td class="font-weight-bold">Total Price</td>
								<td class="text-right font-weight-bold">
									<?php
										$tot3 = $tot2 - $coupon_final_discount;
										$tot3 = n_to_decimal($tot3);
										echo '$'.$tot3;
									?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="faq">
					<div class="panel-group mb_0" id="accordion1" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading1">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
										Apply Shipping
									</a>
								</h4>									
							</div>
							<div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
								<div class="panel-body">
									<form action="" method="post">
									<div class="table-responsive">
										<table class="table table-bordered">
											<tbody>
												<?php
													if(isset($_SESSION['shipping_id']))
													{
														$shipping_id = $_SESSION['shipping_id'];
													}
													else
													{
														$shipping_id = 0;
													}

													$q = $pdo->prepare("SELECT * FROM tbl_shipping WHERE shipping_status=? ORDER BY shipping_order ASC");
													$q->execute(['Active']);
													$res = $q->fetchAll();
													foreach ($res as $row) 
													{
														?>
														<tr>
															<td><input type="radio" name="shipping_id" value="<?php echo $row['shipping_id']; ?>" class="form-control w-auto" <?php if($row['shipping_id'] == $shipping_id) {echo 'checked';} ?>></td>
															<td>
																<?php
																echo '<b>'.$row['shipping_name'].'</b><br>';
																echo nl2br($row['shipping_text']);
																?>
															</td>
															<td>
																<?php echo '$'.$row['shipping_cost']; ?>
															</td>
														</tr>
														<?php
													}
												?>
												
											</tbody>
										</table>
									</div>
									<input type="submit" value="Apply Shipping" class="btn btn-primary mt_10" name="form_shipping_apply">
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading2">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
										Apply Coupon
									</a>
								</h4>									
							</div>
							<div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
								<div class="panel-body">
									<form action="" method="post">
									<input type="text" class="form-control" placeholder="Enter Coupon Code" name="coupon_code">
									<input type="submit" value="Apply Coupon" class="btn btn-primary mt_10" name="form_coupon_apply">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="cart-buttons">
					<?php
					if($tot3 < 0)
					{
						?>
							<div class="text-danger">Sorry! You can not make checkout, because the final price is a negative number.</div>
						<?php
					}
					else
					{
						?><a href="<?php echo BASE_URL; ?>checkout" class="btn btn-info btn-arf btn-block">Checkout</a><?php
					}
					?>
				</div>
				<?php endif; ?>


			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>