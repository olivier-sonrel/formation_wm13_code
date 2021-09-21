<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $faq_title   = sanitize_string($_POST['faq_title']);
    $faq_content = sanitize_ckeditor($_POST['faq_content']);
    $faq_order   = sanitize_int($_POST['faq_order']);

    $valid = 1;

    if($faq_title == '')
    {
        $valid = 0;
        $error_message .= 'Title can not be empty<br>';
    }
    if($faq_content == '')
    {
        $valid = 0;
        $error_message .= 'Content can not be empty<br>';
    }

    if($valid == 1) 
    {
        $statement = $pdo->prepare("UPDATE tbl_faq SET  
                    faq_title=?, 
                    faq_content=?,
                    faq_order=?
                    WHERE faq_id=?
                ");
        $statement->execute(array(
                    $faq_title,
                    $faq_content,
                    $faq_order,
                    $_REQUEST['id']
                ));
        $success_message = 'FAQ is updated successfully!';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM tbl_faq WHERE faq_id=?");
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
                <h4 class="page-title pull-left">Edit FAQ</h4>
                <a href="faq.php" class="btn btn-primary btn-xs">View FAQs</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_faq WHERE faq_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll();
foreach ($result as $row) {
    $faq_title   = $row['faq_title'];
    $faq_content = $row['faq_content'];
    $faq_order   = $row['faq_order'];
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
                            <label for=""><b class="text-muted d-block">FAQ Title *</b></label>
                            <input type="text" class="form-control" name="faq_title" value="<?php echo safe_data($faq_title); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">FAQ Content *</b></label>
                            <textarea class="form-control editor h_100" name="faq_content"><?php echo safe_data($faq_content); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Order</b></label>
                            <input type="text" class="form-control" name="faq_order" value="<?php echo safe_data($faq_order); ?>">
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