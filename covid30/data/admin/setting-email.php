<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $send_email_from  = sanitize_email($_POST['send_email_from']);
    $receive_email_to = sanitize_email($_POST['receive_email_to']);
    $smtp_active      = sanitize_string($_POST['smtp_active']);
    $smtp_ssl         = sanitize_string($_POST['smtp_ssl']);
    $smtp_host        = sanitize_string($_POST['smtp_host']);
    $smtp_port        = sanitize_string($_POST['smtp_port']);
    $smtp_username    = sanitize_string($_POST['smtp_username']);
    $smtp_password    = sanitize_string($_POST['smtp_password']);

    $statement = $pdo->prepare("UPDATE tbl_setting_email SET 
                    send_email_from=?,
                    receive_email_to=?,
                    smtp_active=?,
                    smtp_ssl=?, 
                    smtp_host=?, 
                    smtp_port=?, 
                    smtp_username=?, 
                    smtp_password=?
                    WHERE id=1");
    $statement->execute([ 
                    $send_email_from, 
                    $receive_email_to, 
                    $smtp_active, 
                    $smtp_ssl,
                    $smtp_host,
                    $smtp_port,
                    $smtp_username,
                    $smtp_password 
                ]);

    $success_message = 'Email Setting is updated successfully.';
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Setting - Email</h4>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_setting_email WHERE id=1");
$statement->execute();
$result = $statement->fetchAll();                           
foreach ($result as $row) {
    $send_email_from  = $row['send_email_from'];
    $receive_email_to = $row['receive_email_to'];
    $smtp_active      = $row['smtp_active'];
    $smtp_ssl         = $row['smtp_ssl'];
    $smtp_host        = $row['smtp_host'];
    $smtp_port        = $row['smtp_port'];
    $smtp_username    = $row['smtp_username'];
    $smtp_password    = $row['smtp_password'];
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Send Email From</b></label>
                                    <input type="text" class="form-control" name="send_email_from" value="<?php echo safe_data($send_email_from); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Receive Email To</b></label>
                                    <input type="text" class="form-control" name="receive_email_to" value="<?php echo safe_data($receive_email_to); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">SMTP Active?</b></label>
                                    <div class="d-block">
                                        <select name="smtp_active" class="form-control select2">
                                            <option value="Yes" <?php if($smtp_active == 'Yes') {echo 'selected';} ?>>Yes</option>
                                            <option value="No" <?php if($smtp_active == 'No') {echo 'selected';} ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">SMTP SSL?</b></label>
                                    <div class="d-block">
                                        <select name="smtp_ssl" class="form-control select2">
                                            <option value="Yes" <?php if($smtp_ssl == 'Yes') {echo 'selected';} ?>>Yes</option>
                                            <option value="No" <?php if($smtp_ssl == 'No') {echo 'selected';} ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">SMTP Host</b></label>
                                    <input type="text" class="form-control" name="smtp_host" value="<?php echo safe_data($smtp_host); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">SMTP Port</b></label>
                                    <input type="text" class="form-control" name="smtp_port" value="<?php echo safe_data($smtp_port); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">SMTP Username</b></label>
                                    <input type="text" class="form-control" name="smtp_username" value="<?php echo safe_data($smtp_username); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">SMTP Password</b></label>
                                    <input type="text" class="form-control" name="smtp_password" value="<?php echo safe_data($smtp_password); ?>">
                                </div>
                            </div>
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