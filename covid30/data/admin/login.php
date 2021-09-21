<?php
ob_start();
session_start();
include("inc/config.php");
include("inc/functions.php");
$error_message='';
if(isset($_POST['form1'])) {

    $email = sanitize_email($_POST['email']);
    $password = sanitize_string($_POST['password']);
        
    if(empty($email) || empty($password)) {
        $error_message = 'Email and/or Password can not be empty<br>';
    } else {
        
        $statement = $pdo->prepare("SELECT * FROM tbl_user WHERE email=? AND status=?");
        $statement->execute(array($email,'Active'));
        $total = $statement->rowCount();    
        $result = $statement->fetchAll();    
        if($total==0) {
            $error_message .= 'Email Address does not match<br>';
        } else {       
            foreach($result as $row) { 
                $row_password = $row['password'];
            }
            if(password_verify($password,$row_password)) {
                $_SESSION['user'] = $row;
                header("location: index.php");
            } else {
                $error_message .= 'Password does not match<br>';
            }
        }
    }    
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
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
                        <h4>Sign In</h4>
                        <p>Please sign in first to access to admin panel</p>
                    </div>
                    <?php
                    if( (isset($error_message)) && ($error_message!='') ):
                        echo '<div class="alert-items"><div class="alert alert-danger mb-0" role="alert"><b>';
                        echo safe_data($error_message);
                        echo '</b></div></div>';
                    endif;
                    ?>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail">Email address</label>
                            <input type="email" id="exampleInputEmail" name="email" autocomplete="off">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword">Password</label>
                            <input type="password" id="exampleInputPassword" name="password" autocomplete="off">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name="form1">Login <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="row mb-4 rmber-area mt-3">
                            <div class="col-12 text-center">
                                <a href="forget-password.php">Forgot Password?</a>
                            </div>
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