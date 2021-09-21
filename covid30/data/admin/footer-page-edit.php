<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $page_id = sanitize_int($_POST['page_id']);
    $order1  = sanitize_int($_POST['order1']);


    $statement = $pdo->prepare("UPDATE tbl_footer_page SET  
                page_id=?,
                order1=?
                WHERE id=?
            ");
    $statement->execute(array(
                $page_id,
                $order1,
                $_REQUEST['id']
            ));
    $success_message = 'Footer Page is updated successfully!';
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM tbl_footer_page WHERE id=?");
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
                <h4 class="page-title pull-left">Edit Footer Page</h4>
                <a href="footer-page.php" class="btn btn-primary btn-xs">View Footer Pages</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_footer_page WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll();
foreach ($result as $row) {
    $page_id = $row['page_id'];
    $order1  = $row['order1'];
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
                            <label for=""><b class="text-muted d-block">Select Page *</b></label>
                            <select name="page_id" class="form-control select2">
                                <?php
                                $q = $pdo->prepare("SELECT * FROM tbl_page ORDER BY page_id ASC");
                                $q->execute();
                                $res = $q->fetchAll();
                                foreach ($res as $row) {
                                    ?>
                                    <option value="<?php echo safe_data($row['page_id']); ?>" <?php if($row['page_id'] == $page_id) {echo 'selected';} ?>><?php echo safe_data($row['page_name']); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Order</b></label>
                            <input type="text" class="form-control" name="order1" value="<?php echo safe_data($order1); ?>">
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