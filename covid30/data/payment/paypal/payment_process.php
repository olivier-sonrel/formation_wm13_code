<?php
ob_start();
session_start();
include("../../admin/inc/config.php");
include("../../admin/inc/functions.php");

// Getting Paypal Email
$statement = $pdo->prepare("SELECT * FROM tbl_setting_payment WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$paypal_email = $row['paypal_email'];
}

$error_message = '';

$return_url = BASE_URL.'payment-success.php';
$cancel_url = BASE_URL.'index.php';
$notify_url = BASE_URL.'payment/paypal/verify_process.php';

$payment_date_time = date('Y-m-d H:i:s');

$item_number = uniqid();
$item_name = 'Product Item(s)';
$item_amount = sanitize_float($_POST['amount']);

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
	$querystring = '';
	
	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";
	
	// Append amount& currency (£) to quersytring so it cannot be edited in html
	
	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "amount=".urlencode($item_amount)."&";
	$querystring .= "item_number=".urlencode($item_number)."&";
	
	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);
	
	$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_order'");
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row) {$ai_id=$row[10];}

    if(isset($_SESSION['returning_customer']))
    {
        $c_id = $_SESSION['customer']['customer_id'];
        $c_name = $_SESSION['customer']['customer_name'];
        $c_email = $_SESSION['customer']['customer_email'];
        $c_type = 'Returning Customer';
    }
    elseif(isset($_SESSION['guest']))
    {
        $c_id = $_SESSION['customer_id'];
        $c_name = $_SESSION['customer_name'];
        $c_email = $_SESSION['customer_email'];
        $c_type = $_SESSION['customer_type'];
    }

    $statement = $pdo->prepare("INSERT INTO tbl_order (   
                            customer_id,
                            customer_name,
                            customer_email,
                            customer_type,
                            billing_name,
                            billing_email,
                            billing_phone,
                            billing_country,
                            billing_address,
                            billing_state,
                            billing_city,
                            billing_zip,
                            shipping_name,
                            shipping_email,
                            shipping_phone,
                            shipping_country,
                            shipping_address,
                            shipping_state,
                            shipping_city,
                            shipping_zip,
                            payment_date_time,
                            txnid, 
                            shipping_cost, 
                            coupon_code,
                            coupon_discount, 
                            paid_amount,
                            card_number,
                            card_cvv,
                            card_expiry_month,
                            card_expiry_year,
                            bank_information,
                            payment_method,
                            payment_status,
                            order_no
                        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $statement->execute(array(
                            $c_id,
                            $c_name,
                            $c_email,
                            $c_type,
                            $_SESSION['billing_name'],
                            $_SESSION['billing_email'],
                            $_SESSION['billing_phone'],
                            $_SESSION['billing_country'],
                            $_SESSION['billing_address'],
                            $_SESSION['billing_state'],
                            $_SESSION['billing_city'],
                            $_SESSION['billing_zip'],
                            $_SESSION['shipping_name'],
                            $_SESSION['shipping_email'],
                            $_SESSION['shipping_phone'],
                            $_SESSION['shipping_country'],
                            $_SESSION['shipping_address'],
                            $_SESSION['shipping_state'],
                            $_SESSION['shipping_city'],
                            $_SESSION['shipping_zip'],
                            $payment_date_time,
                            '',
                            $_SESSION['shipping_cost'],
                            $_SESSION['coupon_code'],
                            $_SESSION['coupon_discount'],
                            $_POST['amount'],
                            '',
                            '',
                            '',
                            '',
                            '',
                            'PayPal',
                            'Pending',
                            $item_number
                        ));

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

    for($i=1;$i<=count($arr_cart_product_id);$i++) 
    {

        // Getting product name and price from tbl_product
        $q = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id=?");
        $q->execute([$arr_cart_product_id[$i]]);
        $res = $q->fetchAll();
        foreach ($res as $row) {
            $product_name = $row['product_name'];
            $product_current_price = $row['product_current_price'];
            $product_stock = $row['product_stock'];
        }

        // Inserting data into tbl_order_detail
        $q = $pdo->prepare("INSERT INTO tbl_order_detail (
                        order_id,
                        product_id,
                        product_name,
                        product_price, 
                        product_qty, 
                        payment_status,
                        order_no
                        ) 
                        VALUES (?,?,?,?,?,?,?)");
        $sql = $q->execute(array(
                        $ai_id,
                        $arr_cart_product_id[$i],
                        $product_name,
                        $product_current_price,
                        $arr_cart_product_qty[$i],
                        'Pending',
                        $item_number
                    ));
    }

    unset($_SESSION['cart_product_id']);
    unset($_SESSION['cart_product_qty']);

    unset($_SESSION['shipping_id']);
    unset($_SESSION['shipping_cost']);
    unset($_SESSION['coupon_id']);
    unset($_SESSION['coupon_code']);
    unset($_SESSION['coupon_type']);
    unset($_SESSION['coupon_discount']);

    if($_SESSION['customer_type'] == 'Guest')
    {
        unset($_SESSION['guest']);
        unset($_SESSION['customer_id']);
        unset($_SESSION['customer_type']);
        unset($_SESSION['customer_name']);
        unset($_SESSION['customer_email']);
    }

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

	
	if($sql){
		// Redirect to paypal IPN
		header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
		exit();
	}
	
} else {

	// Response from Paypal

	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
		$req .= "&$key=$value";
	}
	
	// assign posted variables to local variables
	$data['item_name']			= $_POST['item_name'];
	$data['item_number'] 		= $_POST['item_number'];
	$data['payment_status'] 	= $_POST['payment_status'];
	$data['payment_amount'] 	= $_POST['mc_gross'];
	$data['payment_currency']	= $_POST['mc_currency'];
	$data['txn_id']			    = $_POST['txn_id'];
	$data['receiver_email'] 	= $_POST['receiver_email'];
	$data['payer_email'] 		= $_POST['payer_email'];
	$data['custom'] 			= $_POST['custom'];
		
	// post back to PayPal system to validate
	$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	
	$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
	
	if (!$fp) {
		// HTTP ERROR
		
	} else {
		fputs($fp, $header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);
			if (strcmp($res, "VERIFIED") == 0) {
				
				// Used for debugging
				// mail('user@domain.com', 'PAYPAL POST - VERIFIED RESPONSE', print_r($post, true));
				
			
			} else if (strcmp ($res, "INVALID") == 0) {
			

				// PAYMENT INVALID & INVESTIGATE MANUALY!
				// E-mail admin or alert user
				
				// Used for debugging
				//@mail("user@domain.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
			}
		}
	fclose ($fp);
	}
}