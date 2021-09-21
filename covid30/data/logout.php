<?php 
ob_start();
session_start();
include 'admin/inc/config.php'; 
unset($_SESSION['customer']);

unset($_SESSION['cart_product_id']);
unset($_SESSION['cart_product_qty']);

unset($_SESSION['shipping_id']);
unset($_SESSION['shipping_cost']);
unset($_SESSION['coupon_id']);
unset($_SESSION['coupon_code']);
unset($_SESSION['coupon_type']);
unset($_SESSION['coupon_discount']);

unset($_SESSION['guest']);
unset($_SESSION['returning_customer']);
unset($_SESSION['customer_id']);
unset($_SESSION['customer_type']);
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
        
header("location: ".BASE_URL.'login'); 
?>