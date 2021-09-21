<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $shipping_name   = sanitize_string($_POST['shipping_name']);
    $shipping_text   = sanitize_string($_POST['shipping_text']);
    $shipping_cost   = sanitize_int($_POST['shipping_cost']);
    $shipping_order  = sanitize_int($_POST['shipping_order']);
    $shipping_status = sanitize_string($_POST['shipping_status']); 

    $valid = 1;

    if($shipping_name == '')
    {
        $valid = 0;
        $error_message .= 'Shipping Name can not be empty<br>';
    }

    if($shipping_text == '')
    {
        $valid = 0;
        $error_message .= 'Shipping Text can not be empty<br>';
    }

    if($shipping_cost == '')
    {
        $valid = 0;
        $error_message .= 'Shipping Cost can not be empty<br>';
    }

    if($valid == 1) 
    {
        $statement = $pdo->prepare("UPDATE tbl_shipping SET  
                    shipping_name=?,
                    shipping_text=?,
                    shipping_cost=?,
                    shipping_order=?,
                    shipping_status=?
                    WHERE shipping_id=?
                ");
        $statement->execute(array(
                    $shipping_name,
                    $shipping_text,
                    $shipping_cost,
                    $shipping_order,
                    $shipping_status,
                    $_REQUEST['id']
                ));
        $success_message = 'Shipping is updated successfully!';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM tbl_shipping WHERE shipping_id=?");
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
                <h4 class="page-title pull-left">Edit Shipping</h4>
                <a href="shipping.php" class="btn btn-primary btn-xs">View All</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_shipping WHERE shipping_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll();
foreach ($result as $row) {
    $shipping_name    = $row['shipping_name'];
    $shipping_text    = $row['shipping_text'];
    $shipping_cost    = $row['shipping_cost'];
    $shipping_order   = $row['shipping_order'];
    $shipping_status  = $row['shipping_status'];
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
                            <label for=""><b class="text-muted d-block">Shipping Name *</b></label>
                            <input type="text" class="form-control" name="shipping_name" value="<?php echo safe_data($shipping_name); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Shipping Text *</b></label>
                            <textarea name="shipping_text" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($shipping_text); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Shipping Cost *</b></label>
                            <input type="text" class="form-control" name="shipping_cost" value="<?php echo safe_data($shipping_cost); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Order</b></label>
                            <input type="text" class="form-control" name="shipping_order" value="<?php echo safe_data($shipping_order); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Status</b></label>
                            <div class="d-block">
                                <select name="shipping_status" class="form-control select2">
                                    <option value="Active" <?php if($shipping_status == 'Active') {echo 'selected';} ?>>Active</option>
                                    <option value="Inactive" <?php if($shipping_status == 'Inactive') {echo 'selected';} ?>>Inactive</option>
                                </select>
                            </div>
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