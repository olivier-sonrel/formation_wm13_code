<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $et_subject = $_POST['et_subject'];
    $et_content = $_POST['et_content'];

    $valid = 1;

    if($et_subject == '')
    {
        $valid = 0;
        $error_message .= 'Email Template Subject can not be empty<br>';
    }

    if($et_content == '')
    {
        $valid = 0;
        $error_message .= 'Email Template Content can not be empty<br>';
    }

    if($valid == 1) 
    {
        $statement = $pdo->prepare("UPDATE tbl_email_template SET  
                    et_subject=?,
                    et_content=?
                    WHERE et_id=?
                ");
        $statement->execute(array(
                    $et_subject,
                    $et_content,
                    $_REQUEST['id']
                ));
        $success_message = 'Email Template Content is updated successfully!';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM tbl_email_template WHERE et_id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    if( $total == 0 ) {
        header('location: logout.php');
        exit;
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Edit Email Template</h4>
                <a href="email-template.php" class="btn btn-primary btn-xs">View All</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_email_template WHERE et_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll();
foreach ($result as $row) {
    $et_subject = $row['et_subject'];
    $et_content = $row['et_content'];
    $et_name = $row['et_name'];
}
?>

<div class="main-content-inner">
    <div class="row">

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">


                    <?php
                    if( (isset($error_message)) && ($error_message!='') ):
                        echo '<div class="alert-items"><div class="alert alert-danger" role="alert"><b>';
                        echo safe_data($error_message);
                        echo '</b></div></div>';
                    endif;

                    if( (isset($success_message)) && ($success_message!='') ):
                        echo '<div class="alert-items"><div class="alert alert-success" role="alert"><b>';
                        echo safe_data($success_message);
                        echo '</b></div></div>';
                    endif;
                    ?>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Subject *</b></label>
                            <input type="text" class="form-control" name="et_subject" value="<?php echo safe_data($et_subject); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block"><span class="text-danger"><?php echo safe_data($et_name); ?></span> *</b></label>
                            <textarea name="et_content" class="form-control" id="editor" cols="30" rows="10"><?php echo safe_data($et_content); ?></textarea>

                            <div class="font-weight-bold mt_20 text-danger">Parameters You Can Use: </div>
                            <?php
                            if($_REQUEST['id'] == 1)
                            {
                                ?>
                                <div>{{visitor_name}} = Visitor Name</div>
                                <div>{{visitor_email}} = Visitor Email</div>
                                <div>{{visitor_phone}} = Visitor Phone</div>
                                <div>{{visitor_message}} = Visitor Message</div>
                                <?php
                            }

                            if($_REQUEST['id'] == 2)
                            {
                                ?>
                                <div>{{person_name}} = Commenter Name</div>
                                <div>{{person_email}} = Commenter Email</div>
                                <div>{{person_message}} = Commenter Message</div>
                                <div>{{comment_see_url}} = Admin panel link where you will see the comment</div>
                                <?php
                            }

                            if($_REQUEST['id'] == 3)
                            {
                                ?>
                                <div>{{verification_link}} = Subscriber Verification Link</div>
                                <?php
                            }

                            if($_REQUEST['id'] == 4)
                            {
                                ?>
                                <div>{{post_link}} = News View Link</div>
                                <?php
                            }

                            if($_REQUEST['id'] == 5)
                            {
                                ?>
                                <div>{{reset_link}} = Reset Password Page Link</div>
                                <?php
                            }

                            if($_REQUEST['id'] == 6)
                            {
                                ?>
                                <div>{{verification_link}} = Customer Registration Verification Link</div>
                                <?php
                            }

                            if($_REQUEST['id'] == 7)
                            {
                                ?>
                                <div>{{reset_link}} = Reset Password Page Link</div>
                                <?php
                            }

                            if($_REQUEST['id'] == 8)
                            {
                                ?>
                                <div>{{customer_name}} = Customer Name</div>
                                <div>{{order_number}} = Order Number</div>
                                <div>{{payment_method}} = Payment Method Details with Card Information</div>
                                <div>{{payment_date_time}} = Payment Date and Time</div>
                                <div>{{transaction_id}} = Transaction Id</div>
                                <div>{{shipping_cost}} = Shipping Cost</div>
                                <div>{{coupon_code}} = Coupon Code</div>
                                <div>{{coupon_discount}} = Coupon Discount</div>
                                <div>{{paid_amount}} = Total Paid Amount</div>
                                <div>{{payment_status}} = Payment Status (Paid or Completed)</div>
                                <div>{{billing_name}} = Billing Name</div>
                                <div>{{billing_email}} = Billing Email</div>
                                <div>{{billing_phone}} = Billing Phone</div>
                                <div>{{billing_country}} = Billing Country</div>
                                <div>{{billing_address}} = Billing Address</div>
                                <div>{{billing_state}} = Billing State</div>
                                <div>{{billing_city}} = Billing City</div>
                                <div>{{billing_zip}} = Billing Zip Code</div>
                                <div>{{shipping_name}} = Shipping Name</div>
                                <div>{{shipping_email}} = Shipping Email</div>
                                <div>{{shipping_phone}} = Shipping Phone</div>
                                <div>{{shipping_country}} = Shipping Country</div>
                                <div>{{shipping_address}} = Shipping Address</div>
                                <div>{{shipping_state}} = Shipping State</div>
                                <div>{{shipping_city}} = Shipping City</div>
                                <div>{{shipping_zip}} = Shipping Zip Code</div>
                                <div>{{product_detail}} = All Product Name, Price and Quantity</div>
                                
                                <?php
                            }

                            if($_REQUEST['id'] == 9)
                            {
                                ?>
                                <div>{{delivery_status}} = Delivery Status</div>
                                <div>{{delivery_note}} = Delivery Note</div>
                                <div>{{delivery_date_time}} = Delivery Date and Time</div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form1">Update</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
<script>            
    CKEDITOR.replace( 'editor' );
</script>