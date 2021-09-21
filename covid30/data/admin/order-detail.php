<?php require_once('header.php'); ?>

<?php
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

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Order Details</h4>
                <a href="order-completed.php" class="btn btn-primary btn-xs">Completed Orders</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>


<div class="main-content-inner">
    <div class="row">

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <a href="order-invoice.php?id=<?php echo $_REQUEST['id']; ?>" class="btn btn-info btn-xs">See Invoice</a>
                </div>
            </div>
        </div>
  
        <div class="col-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Order Details</h4>
                    <div class="table-responsive">
                        <table id="" class="text-left table table-bordered">
                            <tr>
                                <td class="alert-warning w_150">Order Number</td>
                                <td><?php echo $order_no; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Payment Date Time</td>
                                <td><?php echo $payment_date_time; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Shipping Cost</td>
                                <td>$<?php echo n_to_decimal($shipping_cost); ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Coupon Code</td>
                                <td><?php echo $coupon_code; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Coupon Discount</td>
                                <td>$<?php echo n_to_decimal($coupon_discount); ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Paid Amount</td>
                                <td>$<?php echo $paid_amount; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Payment Status</td>
                                <td>
                                    <?php if($payment_status == 'Completed'): ?>
                                    <a href="javascript:void;" class="btn btn-success btn-xs"><?php echo $payment_status; ?></a>
                                    <?php else: ?>
                                    <a href="javascript:void;" class="btn btn-danger btn-xs"><?php echo $payment_status; ?></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Customer & Payment Gateway Details</h4>
                    <div class="table-responsive">
                        <table id="" class="text-left table table-bordered">
                            <tr>
                                <td class="alert-warning w_150">Customer Type</td>
                                <td><?php echo $customer_type; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning w_150">Customer Name</td>
                                <td><?php echo $customer_name; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Customer Email</td>
                                <td><?php echo $customer_email; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Payment Method</td>
                                <td><?php echo $payment_method; ?></td>
                            </tr>

                            <?php if($payment_method == 'Stripe'): ?>
                            <tr>
                                <td class="alert-warning">Card Number</td>
                                <td><?php echo $card_number; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Card CVV</td>
                                <td><?php echo $card_cvv; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Expiry Month</td>
                                <td><?php echo $card_expiry_month; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Expiry Year</td>
                                <td><?php echo $card_expiry_year; ?></td>
                            </tr>
                            <?php endif; ?>

                            <?php if($payment_status == 'Bank'): ?>
                            <tr>
                                <td class="alert-warning">Bank Information</td>
                                <td><?php echo nl2br($bank_information); ?></td>
                            </tr>
                            <?php endif; ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Billing Information</h4>
                    <div class="table-responsive">
                        <table id="" class="text-left table table-bordered">
                            <tr>
                                <td class="alert-warning w_150">Name</td>
                                <td><?php echo $billing_name; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning w_150">Email</td>
                                <td><?php echo $billing_email; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Phone</td>
                                <td><?php echo $billing_phone; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Country</td>
                                <td><?php echo $billing_country; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Address</td>
                                <td><?php echo $billing_address; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">State</td>
                                <td><?php echo $billing_state; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">City</td>
                                <td><?php echo $billing_city; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Zip Code</td>
                                <td><?php echo $billing_zip; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Shipping Information</h4>
                    <div class="table-responsive">
                        <table id="" class="text-left table table-bordered">
                            <tr>
                                <td class="alert-warning w_150">Name</td>
                                <td><?php echo $shipping_name; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning w_150">Email</td>
                                <td><?php echo $shipping_email; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Phone</td>
                                <td><?php echo $shipping_phone; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Country</td>
                                <td><?php echo $shipping_country; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Address</td>
                                <td><?php echo $shipping_address; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">State</td>
                                <td><?php echo $shipping_state; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">City</td>
                                <td><?php echo $shipping_city; ?></td>
                            </tr>
                            <tr>
                                <td class="alert-warning">Zip Code</td>
                                <td><?php echo $shipping_zip; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Product Information</h4>
                    <div class="table-responsive">
                        <table id="" class="text-left table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>SL</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Product Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=0;
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
                                        <td>
                                            <?php
                                            $s_total = $row['product_price']*$row['product_qty'];
                                            echo '$'.n_to_decimal(safe_data($s_total));
                                            ?>
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
</div>

<?php require_once('footer.php'); ?>