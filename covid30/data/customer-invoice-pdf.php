<?php
ob_start();
session_start();
include("admin/inc/config.php");
include("admin/inc/functions.php");
$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';

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

$dt = date('Y-m-d');
$dt_final = date('d',strtotime($dt)).' '.date('M',strtotime($dt)).' '.date('Y',strtotime($dt));


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


require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Pdf extends Dompdf{
 public function __construct() {
        parent::__construct();
    }
}

$output = '';

$output.= '
<!DOCTYPE HTML>
    <html lang="en-US">
        <head>
            <meta charset="UTF-8">
            <title></title>
            <style>
                .pcon {position: fixed;top: 0;left: 0;}
                .pcon .top .logo {width:50%;float: left;text-align: left;font-size: 14px;font-weight: bold;}
                .pcon .top .logo img {height:70px;}
                .pcon .top .inv_no {width:50%;float: left;text-align: right;font-size: 20px;margin-top:30px;}
                .pcon .top .inv_no span {font-weight: bold;display: block;}

                .pcon .tar {text-align: right;}

                .pcon .bar {width:100%;height:2px;border-bottom: 2px solid #777;padding-top:20px;margin-bottom:20px;}

                .pcon .top1 .i1 {width:25%;float: left;text-align: left;font-size: 14px;}
                .pcon .top1 .i2 {width:25%;float: left;text-align: left;font-size: 14px;}
                .pcon .top1 .i3 {width:25%;float: left;text-align: left;font-size: 14px;}
                .pcon .top1 .i4 {width:25%;float: left;text-align: right;font-size: 14px;}

                .gap-30 {width:100%;height:30px;}

                .pcon .headline {background: #555;color:#fff;padding:10px;font-size:18px;font-weight: bold;margin-bottom:5px;}

                .pcon table.pdf-table {width:100%; border:1px solid #a4a5a7; border-collapse:collapse;}
                .pcon table.pdf-table tr th {background: #ddd;text-align: left;}
                .pcon table.pdf-table tr td {vertical-align:top;}
                .pcon table.pdf-table tr th,
                .pcon table.pdf-table tr td {border: 1px solid #a4a5a7;padding: 10px;border-collapse: collapse;}
                .print-full-width {
                    width:100%;
                }
            </style>
        </head>
        <body>
            <div class="pcon">

                <div class="top">
                    <div class="logo">
                        <img src="uploads/'.$logo.'" alt=""><br>
                        '.nl2br($company_information).'
                    </div>
                    <div class="inv_no">
                        <span>Invoice Number:</span>'.$order_no.'
                    </div>
                </div>

                <div style="clear:both;"></div>

                <div class="bar"></div>
                
                <div style="clear:both;"></div>
                <div class="top1">
                    <div class="i1">
                        <b>Invoiced To:</b> <br>
                        Name: '.$customer_name.' <br>
                        Email: '.$customer_email.' <br>
                        Payment Method: '.$payment_method.' <br>
                        Payment Status: '.$payment_status.' <br>
                    </div>
                    <div class="i1">
                        <b>Billing Info:</b> <br>
                        Name: '.$billing_name.' <br>
                        Email: '.$billing_email.' <br>
                        Phone: '.$billing_phone.' <br>
                        Country: '.$billing_country.' <br>
                        Address: '.$billing_address.' <br>
                        State: '.$billing_state.' <br>
                        City: '.$billing_city.' <br>
                        Zip Code: '.$billing_zip.' <br>
                    </div>
                    <div class="i3">
                        <b>Shipping Info:</b> <br>
                        Name: '.$shipping_name.' <br>
                        Email: '.$shipping_email.' <br>
                        Phone: '.$shipping_phone.' <br>
                        Country: '.$shipping_country.' <br>
                        Address: '.$shipping_address.' <br>
                        State: '.$shipping_state.' <br>
                        City: '.$shipping_city.' <br>
                        Zip Code: '.$shipping_zip.' <br>
                    </div>
                    <div class="i4">
                        <b>Invoice Date & Time:</b> <br>
                        Date: '.$dt_final.' <br>
                        Time: '.date('H:i:s A').' <br>
                    </div>
                </div>

                <div style="clear:both;"></div>
                <div class="gap-30"></div>

                <div class="headline">Product Details</div>

                <table class="pdf-table">
                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th class="tar">Subtotal</th>
                    </tr>
';

$i=0;
$total=0;
$statement = $pdo->prepare("SELECT * FROM tbl_order_detail WHERE order_id=?");
$statement->execute([$_REQUEST['id']]);
$result = $statement->fetchAll();                           
foreach ($result as $row) {
    $i++;
    $output.= '<tr>';
    $output.= '<td>'.safe_data($i).'</td>';
    $output.= '<td>'.safe_data($row['product_name']).'</td>';
    $output.= '<td>$'.n_to_decimal(safe_data($row['product_price'])).'</td>';
    $output.= '<td>'.safe_data($row['product_qty']).'</td>';
    $s_total = $row['product_price']*$row['product_qty'];
    $output .= '<td class="tar">$'.n_to_decimal(safe_data($s_total)).'</td>';
    $output.= '</tr>';
    $total = $total + $s_total;
}

$output .= '                    
                    <tr>
                        <td colspan="4" class="tar">
                            <b>Total:</b>
                        </td>
                        <td class="tar">$'.n_to_decimal($total).'</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="tar">
                            <b>Shipping Cost:</b>
                        </td>
                        <td class="tar">$'.n_to_decimal($shipping_cost).'</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="tar">
                            <b>Coupon Discount:</b>
                        </td>
                        <td class="tar">$'.n_to_decimal($coupon_discount).'</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="tar">
                            <b>Final Price:</b>
                        </td>
                        <td class="tar">$'.n_to_decimal($total).'</td>
                    </tr>
                </table>

            </div>
        </body>
    </html>
';

$pdf = new Pdf();
$file_name = 'invoice-'.$order_no.'.pdf';
$paperOrientation = 'portrait';
$paperSize = 'letter';
$pdf->set_paper($paperSize, $paperOrientation);
$pdf->loadHtml($output);
$pdf->render();
$pdf->stream($file_name, array("Attachment" => false));
?>