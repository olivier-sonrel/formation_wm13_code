<?php
include("../../admin/inc/config.php");

$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
    $keyval = explode ('=', $keyval);
    if (count($keyval) == 2)
        $myPost[$keyval[0]] = urldecode($keyval[1]);
}

// Read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
    $get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
    if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
        $value = urlencode(stripslashes($value));
    } else {
        $value = urlencode($value);
    }
    $req .= "&$key=$value";
}

/*
 * Post IPN data back to PayPal to validate the IPN data is genuine
 * Without this step anyone can fake IPN data
 */
$paypalURL = "https://www.paypal.com/cgi-bin/webscr";
$ch = curl_init($paypalURL);
if ($ch == FALSE) {
    return FALSE;
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSLVERSION, 6);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
$res = curl_exec($ch);

/*
 * Inspect IPN validation result and act accordingly
 * Split response headers and payload, a better way for strcmp
 */ 
$tokens = explode("\r\n\r\n", trim($res));
$res = trim(end($tokens));
if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {

    $statement = $pdo->prepare("UPDATE tbl_order SET 
                        txnid=?, 
                        payment_status=?
                        WHERE order_no=?");
    $sql = $statement->execute(array(
                        $_POST['txn_id'],
                        $_POST['payment_status'],
                        $_POST['item_number']
                    ));

    $statement = $pdo->prepare("UPDATE tbl_order_detail SET 
                        payment_status=?
                        WHERE order_no=?");
    $sql = $statement->execute(array(
                        $_POST['payment_status'],
                        $_POST['item_number']
                    ));



    // Update the stock
    $product_detail = '';
    $ii=0;
    $q = $pdo->prepare("SELECT * FROM tbl_order_detail WHERE order_no=?");
    $q->execute([$_POST['item_number']]);
    $result = $q->fetchAll();
    foreach ($result as $row) {
        $ii++;
        $product_detail .= '
        <b>Product #'.$ii.'</b><br>
        Product Name: '.$row['product_name'].'<br>
        Product Price: $'.$row['product_price'].'<br>
        Product Quantity: '.$row['product_qty'].'<br>
        ';

        $r = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id=?");
        $r->execute([$row['product_id']]);
        $result1 = $r->fetchAll();
        foreach ($result1 as $row1) {

            $final_quantity = $row1['product_stock']-$row['product_qty'];
            
            $s = $pdo->prepare("UPDATE tbl_product SET product_stock=? WHERE product_id=?");
            $s->execute([$final_quantity,$row['product_id']]);
        }
    }

    // Update the tbl_coupon, because this time it is using one time.
    $q = $pdo->prepare("SELECT * FROM tbl_order WHERE order_no=?");
    $q->execute([$_POST['item_number']]);
    $result = $q->fetchAll();
    foreach ($result as $row) {
        $coupon_code = $row['coupon_code'];

        $shipping_cost = $row['shipping_cost'];
        $coupon_discount = $row['coupon_discount'];
        $paid_amount = $row['paid_amount'];

        $customer_name = $row['customer_name'];
        $customer_email = $row['customer_email'];
        $payment_date_time = $row['payment_date_time'];

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
    }

    if($coupon_code != '')
    {
        $q = $pdo->prepare("SELECT * FROM tbl_coupon WHERE coupon_code=?");
        $q->execute([$coupon_code]);
        $result = $q->fetchAll();
        foreach ($result as $row) {
            $coupon_existing_use = $row['coupon_existing_use'];
        }
        $coupon_existing_use = $coupon_existing_use + 1;
        $q = $pdo->prepare("UPDATE tbl_coupon SET coupon_existing_use=? WHERE coupon_code=?");
        $q->execute([$coupon_existing_use,$coupon_code]);
    }

    // Sending email to customer
    $q = $pdo->prepare("SELECT * FROM tbl_setting_email WHERE id=1");
    $q->execute();
    $result = $q->fetchAll();
    foreach ($result as $row) {
        $send_email_from = $row['send_email_from'];
        $receive_email_to = $row['receive_email_to'];
        $smtp_active = $row['smtp_active'];
        $smtp_ssl = $row['smtp_ssl'];
        $smtp_host = $row['smtp_host'];
        $smtp_port = $row['smtp_port'];
        $smtp_username = $row['smtp_username'];
        $smtp_password = $row['smtp_password'];
    }

    $q = $pdo->prepare("SELECT * FROM tbl_email_template WHERE et_id=?");
    $q->execute([8]);
    $res = $q->fetchAll();
    foreach ($res as $row) {
        $et_subject = $row['et_subject'];
        $et_content = $row['et_content'];
    }

    $payment_method = 'Payment Method: PayPal';

    $message = str_replace('{{customer_name}}', $customer_name, $et_content);
    $message = str_replace('{{order_number}}', $_POST['item_number'], $message);
    $message = str_replace('{{payment_method}}', $payment_method, $message);
    $message = str_replace('{{payment_date_time}}', $payment_date_time, $message);
    $message = str_replace('{{transaction_id}}', $_POST['txn_id'], $message);
    $message = str_replace('{{shipping_cost}}', '$'.$shipping_cost, $message);
    $message = str_replace('{{coupon_code}}', $coupon_code, $message);
    $message = str_replace('{{coupon_discount}}', '$'.$coupon_discount, $message);
    $message = str_replace('{{paid_amount}}', '$'.$paid_amount, $message);
    $message = str_replace('{{payment_status}}', 'Completed', $message);
    $message = str_replace('{{billing_name}}', $billing_name, $message);
    $message = str_replace('{{billing_email}}', $billing_email, $message);
    $message = str_replace('{{billing_phone}}', $billing_phone, $message);
    $message = str_replace('{{billing_country}}', $billing_country, $message);
    $message = str_replace('{{billing_address}}', $billing_address, $message);
    $message = str_replace('{{billing_state}}', $billing_state, $message);
    $message = str_replace('{{billing_city}}', $billing_city, $message);
    $message = str_replace('{{billing_zip}}', $billing_zip, $message);
    $message = str_replace('{{shipping_name}}', $shipping_name, $message);
    $message = str_replace('{{shipping_email}}', $shipping_email, $message);
    $message = str_replace('{{shipping_phone}}', $shipping_phone, $message);
    $message = str_replace('{{shipping_country}}', $shipping_country, $message);
    $message = str_replace('{{shipping_address}}', $shipping_address, $message);
    $message = str_replace('{{shipping_state}}', $shipping_state, $message);
    $message = str_replace('{{shipping_city}}', $shipping_city, $message);
    $message = str_replace('{{shipping_zip}}', $shipping_zip, $message);
    $message = str_replace('{{product_detail}}', $product_detail, $message);

    require_once('../../mail/class.phpmailer.php');
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';

    try {
        if($smtp_active == 'Yes')
        {
            if($smtp_ssl == 'Yes')
            {
                $mail->SMTPSecure = "ssl";
            }
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Host     = $smtp_host;
            $mail->Port     = $smtp_port;
            $mail->Username = $smtp_username;
            $mail->Password = $smtp_password;
        }
    
        $mail->addReplyTo($receive_email_to);
        $mail->setFrom($send_email_from);
        $mail->addAddress($customer_email);
        
        $mail->isHTML(true);
        $mail->Subject = $et_subject;

        $mail->Body = $message;
        $mail->send();

    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    

}else{
    $statement = $pdo->prepare("DELETE FROM tbl_order WHERE order_no=?");
    $sql = $statement->execute(array($_POST['item_number']));

    $statement = $pdo->prepare("DELETE FROM tbl_order_detail WHERE order_no=?");
    $sql = $statement->execute(array($_POST['item_number']));
}
?>