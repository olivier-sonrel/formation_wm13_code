<?php require_once('header.php'); ?>

<?php
// Check if the id is valid or not
if( !isset($_REQUEST['id']) ) {
    header('location: cart.php');
    exit;
}

$i=0;
foreach($_SESSION['cart_product_id'] as $value) {
    $i++;
    $arr_cart_product_id[$i] = $value;
}

$i=0;
foreach($_SESSION['cart_product_qty'] as $value) {
    $i++;
    $arr_cart_product_qty[$i] = $value;
}

unset($_SESSION['cart_product_id']);
unset($_SESSION['cart_product_qty']);


$k=1;
for($i=1;$i<=count($arr_cart_product_id);$i++) 
{
    if($arr_cart_product_id[$i] == $_REQUEST['id']) 
    {
        continue;
    }
    else
    {
        $_SESSION['cart_product_id'][$k] = $arr_cart_product_id[$i];
        $_SESSION['cart_product_qty'][$k] = $arr_cart_product_qty[$i];
        $k++;
    }
}

// Check if all items are removed from the cart. If yes, then remove all cart datas like shipping and coupon datas etc.
if(count($_SESSION['cart_product_id']) == 0)
{
    
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
}

$_SESSION['cart_delete_message'] = 'Item is deleted from the cart successfully!';
header('location: cart.php');
?>