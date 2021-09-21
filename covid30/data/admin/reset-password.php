<?php
ob_start();
session_start();
include("inc/config.php");
include("inc/functions.php");
$error_message='';

if( !isset($_REQUEST['email']) || !isset($_REQUEST['token']) )
{
    header('location: '.BASE_URL.'admin/login.php');
    exit;
}

$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE email=? AND token=?");
$statement->execute(array($_REQUEST['email'],$_REQUEST['token']));
$result = $statement->fetchAll();
$tot = $statement->rowCount();
if($tot == 0)
{
    header('location: '.BASE_URL.'admin/login.php');
    exit;
}

if(isset($_POST['form1']))
{
    $valid = 1;

    $new_password = sanitize_string($_POST['new_password']);
    $re_password = sanitize_string($_POST['re_password']);
    
    if( empty($new_password) || empty($re_password) )
    {
        $valid = 0;
        $error_message .= 'Please enter new and retype passwords.<br>';
    }
    else
    {
        if($new_password != $re_password)
        {
            $valid = 0;
            $error_message .= 'Passwords do not match.<br>';
        }
    }   

    if($valid == 1) 
    {
        
        $final_password = password_hash($new_password, PASSWORD_DEFAULT);

        $statement = $pdo->prepare("UPDATE tbl_user SET password=?, token=? WHERE email=?");
        $statement->execute([$final_password,'',$_REQUEST['email']]);
        
        header('location: '.BASE_URL.'admin/reset-password-success.php');
    }    
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    
    <!-- Basic -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    
    <!-- Amchart -->
    <link rel="stylesheet" href="assets/css/export.css" media="all">
    
    <!-- Others -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- Modernizr -->
    <script src="assets/js/modernizr-2.8.3.min.js"></script>

</head>

<body>

    <!-- Login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="" method="post">
                    <div class="login-form-head">
                        <h4>Reset Password</h4>
                        <p>Reset your password from this page</p>
                    </div>
                    <?php
                    if( (isset($error_message)) && ($error_message!='') ):
                        echo '<div class="alert-items"><div class="alert alert-danger mb-0" role="alert"><b>';
                        echo safe_data($error_message);
                        echo '</b></div></div>';
                    endif;
                    if( (isset($success_message)) && ($success_message!='') ):
                        echo '<div class="alert-items"><div class="alert alert-success mb-0" role="alert"><b>';
                        echo safe_data($success_message);
                        echo '</b></div></div>';
                    endif;
                    ?>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password" autocomplete="off">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="re_password">Retype New Password</label>
                            <input type="password" id="re_password" name="re_password" autocomplete="off">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>                        
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name="form1">Reset <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Login area end -->

    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>

    <!-- Basic -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    
    <!-- Others -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>