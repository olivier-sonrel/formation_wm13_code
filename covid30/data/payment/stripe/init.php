<?php
ob_start();
session_start();
include("../../admin/inc/config.php");
include("../../admin/inc/functions.php");

require 'lib/init.php';

// Getting Stripe Keys
$q = $pdo->prepare("SELECT * FROM tbl_setting_payment WHERE id=1");
$q->execute();
$result = $q->fetchAll();                            
foreach ($result as $row) {
    $stripe_public_key = $row['stripe_public_key'];
    $stripe_secret_key = $row['stripe_secret_key'];
}

if (isset($_POST['payment']) && $_POST['payment'] == 'posted' && floatval($_POST['amount']) > 0) {

    \Stripe\Stripe::setApiKey($stripe_secret_key);
    try {
        if (!isset($_POST['stripeToken']))
            throw new Exception("The Stripe Token was not generated correctly");

        $payment_date_time = date('Y-m-d H:i:s');
        $order_no = uniqid();
        $amount = floatval($_POST['amount']);
        $cents = floatval($amount * 100); //converting to cents

        $response = \Stripe\Charge::create(array("amount" => $cents,
                    "currency" => "usd",
                    "card" => $_POST['stripeToken'],
                    //"receipt_email" => $_POST['customer_email'],
                    "description" => 'Stripe Payment'
        ));

        $transaction_id = $response->id; // Its unique charge ID
        $transaction_status = $response->status;

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
                                $transaction_id,
                                $_SESSION['shipping_cost'],
                                $_SESSION['coupon_code'],
                                $_SESSION['coupon_discount'],
                                $_POST['amount'],
                                $_POST['card_number'], 
                                $_POST['card_cvv'], 
                                $_POST['card_expiry_month'], 
                                $_POST['card_expiry_year'],
                                '',
                                'Stripe',
                                'Completed',
                                $order_no
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


        $product_detail = '';
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
                            'Completed',
                            $order_no
                        ));

            $product_detail .= '
            <b>Product #'.$i.'</b><br>
            Product Name: '.$product_name.'<br>
            Product Price: $'.$product_current_price.'<br>
            Product Quantity: '.$arr_cart_product_qty[$i].'<br>
            ';

            // Update the stock
            $final_quantity = $product_stock - $arr_cart_product_qty[$i];
            $q = $pdo->prepare("UPDATE tbl_product SET product_stock=? WHERE product_id=?");
            $q->execute(array($final_quantity,$arr_cart_product_id[$i]));
        }

        // Update the tbl_coupon, because this time it is using one time.
        if($_SESSION['coupon_code'] != '')
        {
            $q = $pdo->prepare("SELECT * FROM tbl_coupon WHERE coupon_code=?");
            $q->execute([$_SESSION['coupon_code']]);
            $res = $q->fetchAll();
            foreach ($res as $row) {
                $coupon_maximum_use = $row['coupon_maximum_use'];
                $coupon_existing_use = $row['coupon_existing_use'];
            }
            $coupon_existing_use = $coupon_existing_use + 1;
            $q = $pdo->prepare("UPDATE tbl_coupon SET coupon_existing_use=? WHERE coupon_code=?");
            $q->execute([$coupon_existing_use,$_SESSION['coupon_code']]);
        }

        // Send email to customers
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

        $payment_method = '
        Payment Method: Stripe<br>
        Card Number: '.$_POST['card_number'].'<br>
        Card CVV: '.$_POST['card_cvv'].'<br>
        Card Expiry Month: '.$_POST['card_expiry_month'].'<br>
        Card Expiry Year: '.$_POST['card_expiry_year'];

        $message = str_replace('{{customer_name}}', $c_name, $et_content);
        $message = str_replace('{{order_number}}', $order_no, $message);
        $message = str_replace('{{payment_method}}', $payment_method, $message);
        $message = str_replace('{{payment_date_time}}', $payment_date_time, $message);
        $message = str_replace('{{transaction_id}}', $transaction_id, $message);
        $message = str_replace('{{shipping_cost}}', '$'.$_SESSION['shipping_cost'], $message);
        $message = str_replace('{{coupon_code}}', $_SESSION['coupon_code'], $message);
        $message = str_replace('{{coupon_discount}}', '$'.$_SESSION['coupon_discount'], $message);
        $message = str_replace('{{paid_amount}}', '$'.$_POST['amount'], $message);
        $message = str_replace('{{payment_status}}', 'Completed', $message);
        $message = str_replace('{{billing_name}}', $_SESSION['billing_name'], $message);
        $message = str_replace('{{billing_email}}', $_SESSION['billing_email'], $message);
        $message = str_replace('{{billing_phone}}', $_SESSION['billing_phone'], $message);
        $message = str_replace('{{billing_country}}', $_SESSION['billing_country'], $message);
        $message = str_replace('{{billing_address}}', $_SESSION['billing_address'], $message);
        $message = str_replace('{{billing_state}}', $_SESSION['billing_state'], $message);
        $message = str_replace('{{billing_city}}', $_SESSION['billing_city'], $message);
        $message = str_replace('{{billing_zip}}', $_SESSION['billing_zip'], $message);
        $message = str_replace('{{shipping_name}}', $_SESSION['shipping_name'], $message);
        $message = str_replace('{{shipping_email}}', $_SESSION['shipping_email'], $message);
        $message = str_replace('{{shipping_phone}}', $_SESSION['shipping_phone'], $message);
        $message = str_replace('{{shipping_country}}', $_SESSION['shipping_country'], $message);
        $message = str_replace('{{shipping_address}}', $_SESSION['shipping_address'], $message);
        $message = str_replace('{{shipping_state}}', $_SESSION['shipping_state'], $message);
        $message = str_replace('{{shipping_city}}', $_SESSION['shipping_city'], $message);
        $message = str_replace('{{shipping_zip}}', $_SESSION['shipping_zip'], $message);
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
            $mail->addAddress($c_email);
            
            $mail->isHTML(true);
            $mail->Subject = $et_subject;
  
            $mail->Body = $message;
            $mail->send();

        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
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

        header('location: ../../payment-success');

    } catch (Exception $e) {
        $error = $e->getMessage();
        ?><script type="text/javascript">alert('Error: <?php echo $error; ?>');</script><?php
    }
}
?>