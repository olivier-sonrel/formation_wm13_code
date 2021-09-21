<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) 
{
    $top_bar_email = sanitize_string($_POST['top_bar_email']);
    $top_bar_phone = sanitize_string($_POST['top_bar_phone']);

    $statement = $pdo->prepare("UPDATE tbl_setting_top_bar SET 
                    top_bar_email=?,
                    top_bar_phone=?
                    WHERE id=1");
    $statement->execute([ 
                    $top_bar_email, 
                    $top_bar_phone
                ]);

    $success_message = 'Top Bar Setting is updated successfully.';
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Setting - Top Bar</h4>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_setting_top_bar WHERE id=1");
$statement->execute();
$result = $statement->fetchAll();                           
foreach ($result as $row) {
    $top_bar_email = $row['top_bar_email'];
    $top_bar_phone = $row['top_bar_phone'];
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
                            <label for=""><b class="text-muted d-block">Email address</b></label>
                            <input type="text" class="form-control" name="top_bar_email" value="<?php echo safe_data($top_bar_email); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Phone Number</b></label>
                            <input type="text" class="form-control" name="top_bar_phone" value="<?php echo safe_data($top_bar_phone); ?>">
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