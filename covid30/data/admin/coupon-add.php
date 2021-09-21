<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $coupon_code        = sanitize_string($_POST['coupon_code']);
    $coupon_type        = sanitize_string($_POST['coupon_type']);
    $coupon_discount    = sanitize_int($_POST['coupon_discount']);
    $coupon_maximum_use = sanitize_int($_POST['coupon_maximum_use']);
    $coupon_start_date  = sanitize_string($_POST['coupon_start_date']);
    $coupon_end_date    = sanitize_string($_POST['coupon_end_date']);
    $coupon_status      = sanitize_string($_POST['coupon_status']);    

    $valid = 1;

    if($coupon_code == '')
    {
        $valid = 0;
        $error_message .= 'Coupon Code can not be empty<br>';
    }
    else
    {
        $q = $pdo->prepare("SELECT * FROM tbl_coupon WHERE coupon_code=?");
        $q->execute([$coupon_code]);
        $tot = $q->rowCount();
        if($tot)
        {
            $valid = 0;
            $error_message .= 'Coupon Code already exists<br>';       
        }
    }

    if($coupon_discount == '')
    {
        $valid = 0;
        $error_message .= 'Discount can not be empty<br>';
    }

    if($coupon_maximum_use == '')
    {
        $valid = 0;
        $error_message .= 'Maximum Use can not be empty<br>';
    }

    if($coupon_start_date == '')
    {
        $valid = 0;
        $error_message .= 'Start Date can not be empty<br>';
    }

    if($coupon_end_date == '')
    {
        $valid = 0;
        $error_message .= 'End Date can not be empty<br>';
    }

    if($valid == 1)
    {
        $statement = $pdo->prepare("INSERT INTO tbl_coupon (
                            coupon_code,
                            coupon_type,
                            coupon_discount,
                            coupon_maximum_use,
                            coupon_existing_use,
                            coupon_start_date,
                            coupon_end_date,
                            coupon_status
                        ) VALUES (?,?,?,?,?,?,?,?)");
        $statement->execute(array(
                            $coupon_code,
                            $coupon_type,
                            $coupon_discount,
                            $coupon_maximum_use,
                            0,
                            $coupon_start_date,
                            $coupon_end_date,
                            $coupon_status
                        ));
            
        $success_message = 'Coupon is added successfully!';
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Add Coupon</h4>
                <a href="coupon.php" class="btn btn-primary btn-xs">View All</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>


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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Coupon Code *</b></label>
                                    <input type="text" class="form-control" name="coupon_code">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Coupon Type *</b></label>
                                    <select name="coupon_type" class="form-control select2">
                                        <option value="Percentage">Percentage</option>
                                        <option value="Amount">Amount</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Coupon Discount *</b></label>
                                    <input type="text" class="form-control" name="coupon_discount">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Coupon Maximum Use *</b></label>
                                    <input type="text" class="form-control" name="coupon_maximum_use">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Coupon Start Date *</b></label>
                                    <input type="text" class="form-control" name="coupon_start_date" id="datepicker1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Coupon End Date *</b></label>
                                    <input type="text" class="form-control" name="coupon_end_date" id="datepicker2">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Status</b></label>
                            <div class="d-block">
                                <select name="coupon_status" class="form-control select2">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form1">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>