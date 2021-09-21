<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) 
{
    $contact_address = sanitize_string($_POST['contact_address']);
    $contact_phone   = sanitize_string($_POST['contact_phone']);
    $contact_email   = sanitize_email($_POST['contact_email']);

    $statement = $pdo->prepare("UPDATE tbl_setting_contact SET 
                    contact_address=?,
                    contact_phone=?,
                    contact_email=?
                    WHERE id=1");
    $statement->execute([ 
                    $contact_address, 
                    $contact_phone,
                    $contact_email
                ]);

    $success_message = 'Contact Page Setting is updated successfully.';
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Setting - Contact Page</h4>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_setting_contact WHERE id=1");
$statement->execute();
$result = $statement->fetchAll();                           
foreach ($result as $row) {
    $contact_address = $row['contact_address'];
    $contact_phone = $row['contact_phone'];
    $contact_email = $row['contact_email'];
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
                            <label for=""><b class="text-muted d-block">Address</b></label>
                            <textarea name="contact_address" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($contact_address); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Phone Number</b></label>
                            <textarea name="contact_phone" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($contact_phone); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Email address</b></label>
                            <textarea name="contact_email" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($contact_email); ?></textarea>
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