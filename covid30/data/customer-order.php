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
$q = $pdo->prepare("SELECT * FROM tbl_setting_logo WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $logo = $row['logo'];
}
$q = $pdo->prepare("SELECT * FROM tbl_setting_order WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $company_information = $row['company_information'];
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
		<h1>Orders</h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Orders</li>
		  	</ol>
		</nav>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-3">				
				<div class="user-sidebar">
					<?php require_once('customer-sidebar.php'); ?>
				</div>
			</div>
			<div class="col-md-9">				
				<div class="table-responsive-md">
					<table class="table table-bordered" id="example">
						<thead>
							<tr class="table-info">
								<th scope="col">Serial</th>
								<th scope="col">Order Number</th>
								<th scope="col">Paid Amount</th>
								<th scope="col">Payment Status</th>
								<th scope="col">Last Delivery Status</th>
								<th scope="col">Detail</th>
							</tr>
						</thead>
						<tbody>
							<?php
                                $i=0;
                                $q = $pdo->prepare("SELECT * FROM tbl_order WHERE customer_id=? ORDER BY id DESC");
                                $q->execute([$_SESSION['customer']['customer_id']]);
                                $result = $q->fetchAll();
                                foreach ($result as $row) {
                                    $i++;
                                    ?>
									<tr>
										<td><?php echo safe_data($i); ?></td>
										<td><?php echo safe_data($row['order_no']); ?></td>
										<td>$<?php echo safe_data($row['paid_amount']); ?></td>
										<td>
											<?php if($row['payment_status'] == 'Completed'): ?>
											<a href="javascript:void;" class="btn btn-success btn-sm"><?php echo safe_data($row['payment_status']); ?></a>
											<?php else: ?>
											<a href="javascript:void;" class="btn btn-danger btn-sm"><?php echo safe_data($row['payment_status']); ?></a>
											<?php endif; ?>											
										</td>
										<td>
											<?php
                                            $r = $pdo->prepare("SELECT * FROM tbl_order_delivery WHERE order_no=? ORDER BY delivery_id DESC LIMIT 1");
                                            $r->execute([$row['order_no']]);
                                            $res1 = $r->fetchAll();
                                            foreach ($res1 as $row1) {
                                                echo safe_data($row1['delivery_status']);
                                            }
                                            ?>
										</td>
										<td>
											<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="" class="dropdown-item" data-toggle="modal" data-target="#modd<?php echo safe_data($i); ?>"><i class="fa fa-eye"></i> Details</a>
                                                <a href="customer-invoice.php?id=<?php echo safe_data($row['id']); ?>" class="dropdown-item"><i class="fa fa-life-ring"></i> Invoice</a>
                                            </div>										
											<div class="modal fade" id="modd<?php echo safe_data($i); ?>">
                                                <div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title font-weight-bold mb_0" id="exampleModalLabel">Order Details</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<h6 class="font-weight-bold mb_5">Order Details</h6>
															<div class="table-responsive">
																<table class="table table-sm w-100-p">
																	<tr>
										                                <td class="alert-warning w-200">Order Number</td>
										                                <td><?php echo safe_data($row['order_no']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Payment Date Time</td>
										                                <td><?php echo safe_data($row['payment_date_time']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Shipping Cost</td>
										                                <td>$<?php echo safe_data(n_to_decimal($row['shipping_cost'])); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Coupon Code</td>
										                                <td><?php echo safe_data($row['coupon_code']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Coupon Discount</td>
										                                <td>$<?php echo safe_data(n_to_decimal($row['coupon_discount'])); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Paid Amount</td>
										                                <td>$<?php echo safe_data($row['paid_amount']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Payment Status</td>
										                                <td>
										                                    <?php if($row['payment_status'] == 'Completed'): ?>
										                                    <a href="javascript:void;" class="btn btn-success btn-sm"><?php echo safe_data($row['payment_status']); ?></a>
										                                    <?php else: ?>
										                                    <a href="javascript:void;" class="btn btn-danger btn-sm"><?php echo safe_data($row['payment_status']); ?></a>
										                                    <?php endif; ?>
										                                </td>
										                            </tr>
																</table>
															</div>

															<h6 class="font-weight-bold mt_20 mb_5">Customer & Payment Gateway Details</h6>
															<div class="table-responsive">
																<table class="table table-sm w-100-p">
																	<tr>
										                                <td class="alert-warning w-200">Customer Type</td>
										                                <td><?php echo safe_data($row['customer_type']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning w_150">Customer Name</td>
										                                <td><?php echo safe_data($row['customer_name']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Customer Email</td>
										                                <td><?php echo safe_data($row['customer_email']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Payment Method</td>
										                                <td><?php echo safe_data($row['payment_method']); ?></td>
										                            </tr>

										                            <?php if($row['payment_method'] == 'Stripe'): ?>
										                            <tr>
										                                <td class="alert-warning">Card Number</td>
										                                <td><?php echo safe_data($row['card_number']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Card CVV</td>
										                                <td><?php echo safe_data($row['card_cvv']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Expiry Month</td>
										                                <td><?php echo safe_data($row['card_expiry_month']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Expiry Year</td>
										                                <td><?php echo safe_data($row['card_expiry_year']); ?></td>
										                            </tr>
										                            <?php endif; ?>

										                            <?php if($row['payment_status'] == 'Bank'): ?>
										                            <tr>
										                                <td class="alert-warning">Bank Information</td>
										                                <td><?php echo safe_data(nl2br($row['bank_information'])); ?></td>
										                            </tr>
										                            <?php endif; ?>
																</table>
															</div>


															<h6 class="font-weight-bold mt_20 mb_5">Billing Information</h6>
															<div class="table-responsive">
																<table class="table table-sm w-100-p">
																	<tr>
										                                <td class="alert-warning w-200">Name</td>
										                                <td><?php echo safe_data($row['billing_name']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Email</td>
										                                <td><?php echo safe_data($row['billing_email']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Phone</td>
										                                <td><?php echo safe_data($row['billing_phone']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Country</td>
										                                <td><?php echo safe_data($row['billing_country']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Address</td>
										                                <td><?php echo safe_data($row['billing_address']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">State</td>
										                                <td><?php echo safe_data($row['billing_state']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">City</td>
										                                <td><?php echo safe_data($row['billing_city']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Zip Code</td>
										                                <td><?php echo safe_data($row['billing_zip']); ?></td>
										                            </tr>
																</table>
															</div>



															<h6 class="font-weight-bold mt_20 mb_5">Shipping Information</h6>
															<div class="table-responsive">
																<table class="table table-sm w-100-p">
																	<tr>
										                                <td class="alert-warning w-200">Name</td>
										                                <td><?php echo safe_data($row['shipping_name']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Email</td>
										                                <td><?php echo safe_data($row['shipping_email']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Phone</td>
										                                <td><?php echo safe_data($row['shipping_phone']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Country</td>
										                                <td><?php echo safe_data($row['shipping_country']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Address</td>
										                                <td><?php echo safe_data($row['shipping_address']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">State</td>
										                                <td><?php echo safe_data($row['shipping_state']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">City</td>
										                                <td><?php echo safe_data($row['shipping_city']); ?></td>
										                            </tr>
										                            <tr>
										                                <td class="alert-warning">Zip Code</td>
										                                <td><?php echo safe_data($row['shipping_zip']); ?></td>
										                            </tr>
																</table>
															</div>


															<h6 class="font-weight-bold mt_20 mb_5">Product Information</h6>
															<div class="table-responsive">
																<table class="table table-sm w-100-p">
																	<tr>
									                                    <th>SL</th>
									                                    <th>Product Name</th>
									                                    <th>Product Price</th>
									                                    <th>Product Quantity</th>
									                                    <th>Subtotal</th>
									                                </tr>
									                                <?php
										                                $j=0;
										                                $r = $pdo->prepare("SELECT * FROM tbl_order_detail WHERE order_id=?");
										                                $r->execute([$row['id']]);
										                                $result1 = $r->fetchAll();     
										                                foreach ($result1 as $row1) {
										                                    $j++;
										                                    ?>
										                                    <tr>
										                                        <td><?php echo safe_data($j); ?></td>
										                                        <td><?php echo safe_data($row1['product_name']); ?></td>
										                                        <td>$<?php echo n_to_decimal(safe_data($row1['product_price'])); ?></td>
										                                        <td><?php echo safe_data($row1['product_qty']); ?></td>
										                                        <td>
										                                            <?php
										                                            $s_total = $row1['product_price']*$row1['product_qty'];
										                                            echo '$'.n_to_decimal(safe_data($s_total));
										                                            ?>
										                                        </td>
										                                    </tr>
										                                    <?php
										                                }
										                                ?>
																</table>
															</div>



														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
                                    <?php
                                }
                            ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>