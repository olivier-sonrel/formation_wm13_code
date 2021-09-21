<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) 
{
    $total_recent_news = sanitize_int($_POST['total_recent_news']);

    $statement = $pdo->prepare("UPDATE tbl_setting_sidebar SET 
                    total_recent_news=?
                    WHERE id=1");
    $statement->execute([ 
                    $total_recent_news
                ]);

    $success_message = 'Sidebar Setting is updated successfully.';
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Setting - Sidebar</h4>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_setting_sidebar WHERE id=1");
$statement->execute();
$result = $statement->fetchAll();                           
foreach ($result as $row) {
    $total_recent_news = $row['total_recent_news'];
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
                            <label for=""><b class="text-muted d-block">Total Recent News</b></label>
                            <input type="text" class="form-control" name="total_recent_news" value="<?php echo safe_data($total_recent_news); ?>">
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