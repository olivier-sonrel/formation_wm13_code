<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $footer_address = sanitize_string($_POST['footer_address']);
    $footer_email = sanitize_string($_POST['footer_email']);
    $footer_phone = sanitize_string($_POST['footer_phone']);
    $copyright = sanitize_string($_POST['copyright']);

    $statement = $pdo->prepare("UPDATE tbl_setting_footer SET 
                    footer_address=?,
                    footer_email=?,
                    footer_phone=?,
                    copyright=?
                    WHERE id=?");
    $statement->execute([ 
                    $footer_address,
                    $footer_email,
                    $footer_phone,
                    $copyright,
                    1
                ]);

    $success_message = 'Footer Setting is updated successfully.';
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Setting - Footer</h4>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_setting_footer WHERE id=1");
$statement->execute();
$result = $statement->fetchAll();                           
foreach ($result as $row) {
    $footer_address = $row['footer_address'];
    $footer_email = $row['footer_email'];
    $footer_phone = $row['footer_phone'];
    $copyright = $row['copyright'];
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
                            <label for=""><b class="text-muted d-block">Footer Address</b></label>
                            <input type="text" name="footer_address" class="form-control" value="<?php echo safe_data($footer_address); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Footer Email</b></label>
                            <input type="text" name="footer_email" class="form-control" value="<?php echo safe_data($footer_email); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Footer Phone</b></label>
                            <input type="text" name="footer_phone" class="form-control" value="<?php echo safe_data($footer_phone); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Copyright</b></label>
                            <textarea name="copyright" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($copyright); ?></textarea>
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