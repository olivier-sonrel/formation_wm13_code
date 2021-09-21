<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) 
{
    $paypal_email      = sanitize_email($_POST['paypal_email']);
    $stripe_public_key = sanitize_string($_POST['stripe_public_key']);
    $stripe_secret_key = sanitize_string($_POST['stripe_secret_key']);

    $statement = $pdo->prepare("UPDATE tbl_setting_payment SET 
                    paypal_email=?,
                    stripe_public_key=?,
                    stripe_secret_key=?
                    WHERE id=1");
    $statement->execute([ 
                    $paypal_email, 
                    $stripe_public_key,
                    $stripe_secret_key
                ]);

    $success_message = 'Payment Setting is updated successfully.';
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Setting - Payment</h4>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_setting_payment WHERE id=1");
$statement->execute();
$result = $statement->fetchAll();                           
foreach ($result as $row) {
    $paypal_email      = $row['paypal_email'];
    $stripe_public_key = $row['stripe_public_key'];
    $stripe_secret_key = $row['stripe_secret_key'];
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
                            <label for=""><b class="text-muted d-block">PayPal Email</b></label>
                            <input type="text" name="paypal_email" class="form-control" value="<?php echo $paypal_email; ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Stripe Public Key</b></label>
                            <input type="text" name="stripe_public_key" class="form-control" value="<?php echo $stripe_public_key; ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Stripe Secret Key</b></label>
                            <input type="text" name="stripe_secret_key" class="form-control" value="<?php echo $stripe_secret_key; ?>">
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