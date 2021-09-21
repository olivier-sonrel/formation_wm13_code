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

if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $q = $pdo->prepare("SELECT * FROM tbl_order WHERE id=?");
    $q->execute(array($_REQUEST['id']));
    $total = $q->rowCount();
    $res = $q->fetchAll();
    if( $total == 0 ) {
        header('location: logout.php');
        exit;
    }
}

foreach($res as $row)
{
    $id = $row['id'];
    $customer_id = $row['customer_id'];
    $customer_name = $row['customer_name'];
    $customer_email = $row['customer_email'];
    $customer_type = $row['customer_type'];
    $billing_name = $row['billing_name'];
    $billing_email = $row['billing_email'];
    $billing_phone = $row['billing_phone'];
    $billing_country = $row['billing_country'];
    $billing_address = $row['billing_address'];
    $billing_state = $row['billing_state'];
    $billing_city = $row['billing_city'];
    $billing_zip = $row['billing_zip'];
    $shipping_name = $row['shipping_name'];
    $shipping_email = $row['shipping_email'];
    $shipping_phone = $row['shipping_phone'];
    $shipping_country = $row['shipping_country'];
    $shipping_address = $row['shipping_address'];
    $shipping_state = $row['shipping_state'];
    $shipping_city = $row['shipping_city'];
    $shipping_zip = $row['shipping_zip'];
    $payment_date_time = $row['payment_date_time'];
    $txnid = $row['txnid'];
    $shipping_cost = $row['shipping_cost'];
    $coupon_code = $row['coupon_code'];
    $coupon_discount = $row['coupon_discount'];
    $paid_amount = $row['paid_amount'];
    $card_number = $row['card_number'];
    $card_cvv = $row['card_cvv'];
    $card_expiry_month = $row['card_expiry_month'];
    $card_expiry_year = $row['card_expiry_year'];
    $bank_information = $row['bank_information'];
    $payment_method = $row['payment_method'];
    $payment_status = $row['payment_status'];
    $order_no = $row['order_no'];
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
		<h1>Invoice</h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Invoice</li>
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
				<div class="row">
                    <div class="col-md-12">
                        <div class="i2 mt_5 mb_5 text-right">
                            <a onClick="printDiv('printablediv')" class="btn btn-info btn-sm mr_5 text-white">Print Invoice</a>
                            <a href="<?php echo BASE_URL; ?>customer-invoice-pdf.php?id=<?php echo $_REQUEST['id']; ?>" class="btn btn-info btn-sm">Download Invoice</a>
                        </div>
                    </div>
                </div>
                <div id="printablediv">
                <div class="customer-invoice">
					<div class="row top-head">
						<div class="col-md-6">
							<div class="left">
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
		                        <img src="<?php echo BASE_URL; ?>uploads/<?php echo $logo; ?>" alt="">
		                        <div class="company-info">
		                            <?php echo nl2br($company_information); ?>
		                        </div>
	                        </div>
						</div>
						<div class="col-md-6">
							<div class="right">
								<div class="i1">Invoice No: <?php echo $order_no; ?></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<div class="i3">
                                <h3>Invoiced To</h3>
                                <p>
                                    Name: <?php echo $customer_name; ?><br>
                                    Email: <?php echo $customer_email; ?><br>
                                    Payment Method: <?php echo $payment_method; ?><br>
                                    Payment Status: <?php echo $payment_status; ?>
                                </p>
                            </div>
						</div>
						<div class="col-md-3">
							<div class="i3">
                                <h3>Billing Info</h3>
                                <p>
                                    Name: <?php echo $billing_name; ?><br>
                                    Email: <?php echo $billing_email; ?><br>
                                    Phone: <?php echo $billing_phone; ?><br>
                                    Country: <?php echo $billing_country; ?><br>
                                    Address: <?php echo $billing_address; ?><br>
                                    State: <?php echo $billing_state; ?><br>
                                    City: <?php echo $billing_city; ?><br>
                                    Zip Code: <?php echo $billing_zip; ?>
                                </p>
                            </div>
						</div>
						<div class="col-md-3">
							<div class="i3">
								<h3>Shipping Info</h3>
	                            <p>
                                    Name: <?php echo $shipping_name; ?><br>
                                    Email: <?php echo $shipping_email; ?><br>
                                    Phone: <?php echo $shipping_phone; ?><br>
                                    Country: <?php echo $shipping_country; ?><br>
                                    Address: <?php echo $shipping_address; ?><br>
                                    State: <?php echo $shipping_state; ?><br>
                                    City: <?php echo $shipping_city; ?><br>
                                    Zip Code: <?php echo $shipping_zip; ?>
                                </p>
                            </div>
						</div>
						<div class="col-md-3">
							<div class="i3">
								<h3>Invoice Date & Time</h3>
	                            <p>
	                                Date: 
	                                <?php 
	                                $dt = date('Y-m-d');
	                                echo date('d',strtotime($dt)).' '.date('M',strtotime($dt)).' '.date('Y',strtotime($dt));
	                                ?>
                                    <br>
	                                Time: 
	                                <?php echo date('H:i:s A'); ?>
	                            </p>
	                        </div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="i3 mb_10">
								<h3>Product Details</h3>
							</div>
							<div class="table-responsive">
                                <table class="table table-sm table-bordered table-hover text-left">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th class="text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=0;
                                        $total=0;
                                        $statement = $pdo->prepare("SELECT * FROM tbl_order_detail WHERE order_id=?");
                                        $statement->execute([$_REQUEST['id']]);
                                        $result = $statement->fetchAll();                           
                                        foreach ($result as $row) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo safe_data($i); ?></td>
                                                <td><?php echo safe_data($row['product_name']); ?></td>
                                                <td>$<?php echo n_to_decimal(safe_data($row['product_price'])); ?></td>
                                                <td><?php echo safe_data($row['product_qty']); ?></td>
                                                <td class="text-right">
                                                    <?php
                                                    $s_total = $row['product_price']*$row['product_qty'];
                                                    echo '$'.n_to_decimal(safe_data($s_total));
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $total = $total + $s_total;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot class="text-right">
                                        <tr>
                                            <td colspan="4">Total Price: </td>
                                            <td>$<?php echo n_to_decimal($total); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">Shipping Cost: </td>
                                            <td>+$<?php echo n_to_decimal($shipping_cost); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">Coupon Discount: </td>
                                            <td>-$<?php echo n_to_decimal($coupon_discount); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">Final Price: </td>
                                            <td>$<?php echo n_to_decimal($total); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
						</div>
					</div>
				</div>
                </div>

				<div class="table-responsive-md">
					<table class="table table-bordered" id="example">
						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>