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
        $statement = $pdo->prepare("INSERT INTO tbl_footer_link (
                            name,
                            url,
                            order1
                        ) VALUES (?,?,?)");
        $statement->execute(array(
                            $name,
                            $url,
                            $order1
                        ));
            
        $success_message = 'Footer Link is added successfully!';
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Add Footer Link</h4>
                <a href="footer-link.php" class="btn btn-primary btn-xs">View Footer Links</a>
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
                            <label for=""><b class="text-muted d-block">Name *</b></label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">URL *</b></label>
                            <input type="text" class="form-control" name="url">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Order</b></label>
                            <input type="text" class="form-control" name="order1">
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