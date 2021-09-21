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
        $statement = $pdo->prepare("INSERT INTO tbl_faq (
                            faq_title,
                            faq_content,
                            faq_order
                        ) VALUES (?,?,?)");
        $statement->execute(array(
                            $faq_title,
                            $faq_content,
                            $faq_order
                        ));
            
        $success_message = 'FAQ is added successfully!';
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Add FAQ</h4>
                <a href="faq.php" class="btn btn-primary btn-xs">View FAQs</a>
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
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">FAQ Title *</b></label>
                            <input type="text" class="form-control" name="faq_title">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">FAQ Content *</b></label>
                            <textarea class="form-control editor h_100" name="faq_content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Order</b></label>
                            <input type="text" class="form-control" name="faq_order">
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