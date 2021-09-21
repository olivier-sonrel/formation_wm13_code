<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $name   = sanitize_string($_POST['name']);
    $url    = sanitize_url($_POST['url']);
    $order1 = sanitize_int($_POST['order1']);

    $valid = 1;

    if($name == '')
    {
        $valid = 0;
        $error_message .= 'Name can not be empty<br>';
    }

    if($url == '')
    {
        $valid = 0;
        $error_message .= 'URL can not be empty<br>';
    }

    if($valid == 1) 
    {
        $statement = $pdo->prepare("UPDATE tbl_footer_link SET  
                    name=?,
                    url=?,
                    order1=?
                    WHERE id=?
                ");
        $statement->execute(array(
                    $name,
                    $url,
                    $order1,
                    $_REQUEST['id']
                ));
        $success_message = 'Footer Link is updated successfully!';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM tbl_footer_link WHERE id=?");
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
                <h4 class="page-title pull-left">Edit Footer Link</h4>
                <a href="footer-link.php" class="btn btn-primary btn-xs">View Footer Links</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_footer_link WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll();
foreach ($result as $row) {
    $name   = $row['name'];
    $url    = $row['url'];
    $order1 = $row['order1'];
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
                            <label for=""><b class="text-muted d-block">Name *</b></label>
                            <input type="text" class="form-control" name="name" value="<?php echo safe_data($name); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">URL *</b></label>
                            <input type="text" class="form-control" name="url" value="<?php echo safe_data($url); ?>">
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