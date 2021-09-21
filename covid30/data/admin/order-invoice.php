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

<div class="page-title-area do-not-print">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Order Details</h4>
                <a href="order-detail.php?id=<?php echo $_REQUEST['id']; ?>" class="btn btn-primary btn-xs">Back to previous page</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>


<div class="main-content-inner">
    <div class="row">       
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-area">
                        <div class="invoice-head">
                            <div class="row">
                                <div class="iv-left col-5">
                                    <span> 
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
                                <div class="iv-right col-7 text-md-right">
                                    <div>
                                        <span>Invoice No: <?php echo $order_no; ?></span>
                                        <div class="mt_10">
                                            <a href="javascript:window.print();" class="btn btn-info btn-xs mr_5 do-not-print">Print Invoice</a>
                                            <a href="order-invoice-pdf.php?id=<?php echo $_REQUEST['id']; ?>" class="btn btn-info btn-xs do-not-print">Download Invoice</a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="invoice-address">
                                    <h5>Invoiced To</h5>
                                    <p>Name: <?php echo $customer_name; ?></p>
                                    <p>Email: <?php echo $customer_email; ?></p>
                                    <p>Payment Method: <?php echo $payment_method; ?></p>
                                    <p>Payment Status: <?php echo $payment_status; ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="invoice-address">
                                    <h5>Billing Info</h5>
                                    <p>Name: <?php echo $billing_name; ?></p>
                                    <p>Email: <?php echo $billing_email; ?></p>
                                    <p>Phone: <?php echo $billing_phone; ?></p>
                                    <p>Country: <?php echo $billing_country; ?></p>
                                    <p>Address: <?php echo $billing_address; ?></p>
                                    <p>State: <?php echo $billing_state; ?></p>
                                    <p>City: <?php echo $billing_city; ?></p>
                                    <p>Zip Code: <?php echo $billing_zip; ?></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="invoice-address">
                                    <h5>Shipping Info</h5>
                                    <p>Name: <?php echo $shipping_name; ?></p>
                                    <p>Email: <?php echo $shipping_email; ?></p>
                                    <p>Phone: <?php echo $shipping_phone; ?></p>
                                    <p>Country: <?php echo $shipping_country; ?></p>
                                    <p>Address: <?php echo $shipping_address; ?></p>
                                    <p>State: <?php echo $shipping_state; ?></p>
                                    <p>City: <?php echo $shipping_city; ?></p>
                                    <p>Zip Code: <?php echo $shipping_zip; ?></p>
                                </div>
                            </div>
                            <div class="col-md-3 text-md-right">
                                <ul class="invoice-address">
                                    <h5>Invoice Date & Time</h5>
                                    <p>
                                        Date: 
                                        <?php 
                                        $dt = date('Y-m-d');
                                        echo date('d',strtotime($dt)).' '.date('M',strtotime($dt)).' '.date('Y',strtotime($dt));
                                        ?>
                                    </p>
                                    <p>
                                        Time: 
                                        <?php echo date('H:i:s A'); ?>
                                    </p>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice-address mt-5">
                                    <h5>Product Details</h5>
                                </div>
                                <div class="invoice-table table-responsive">
                                    <table class="table table-bordered table-hover text-left">
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
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>