<?php
ob_start();
session_start();
include("inc/config.php");
include("inc/functions.php");
$error_message='';
if(isset($_POST['form1'])) {

    $valid = 1;
        
    $email = sanitize_email($_POST['email']);
        
    if(empty($email)) 
    {
        $valid = 0;
        $error_message .= "Email can not be empty.<br>";
    }
    else 
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
        {
            $valid = 0;
            $error_message .= 'Email address must be valid.<br>';
        } 
        else 
        {
            $statement = $pdo->prepare("SELECT * FROM tbl_user WHERE email=?");
            $statement->execute(array($email));
            $total = $statement->rowCount();                        
            if(!$total) {
                $valid = 0;
                $error_message .= 'You email address is not found in our system.<br>';
            }
        }
    }

    if($valid == 1)
    {
        $q = $pdo->prepare("SELECT * FROM tbl_setting_email WHERE id=1");
        $q->execute();
        $result = $q->fetchAll();
        foreach ($result as $row) {
            $send_email_from = $row['send_email_from'];
            $receive_email_to = $row['receive_email_to'];
            $smtp_active = $row['smtp_active'];
            $smtp_ssl = $row['smtp_ssl'];
            $smtp_host = $row['smtp_host'];
            $smtp_port = $row['smtp_port'];
            $smtp_username = $row['smtp_username'];
            $smtp_password = $row['smtp_password'];
        }

        $q = $pdo->prepare("SELECT * FROM tbl_email_template WHERE et_id=?");
        $q->execute([5]);
        $res = $q->fetchAll();
        foreach ($res as $row) {
            $et_subject = $row['et_subject'];
            $et_content = $row['et_content'];
        }

        $token = hash('sha256',time());

        $q = $pdo->prepare("UPDATE tbl_user SET token=? WHERE email=?");
        $q->execute(array($token,$email));
        
        $reset_link = BASE_URL.'admin/reset-password.php?email='.$email.'&token='.$token;

        $message = str_replace('{{reset_link}}', $reset_link, $et_content);

        require_once('../mail/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';

        try {

            if($smtp_active == 'Yes')
            {
                if($smtp_ssl == 'Yes')
                {
                    $mail->SMTPSecure = "ssl";
                }
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->Host     = $smtp_host;
                $mail->Port     = $smtp_port;
                $mail->Username = $smtp_username;
                $mail->Password = $smtp_password;
            }
        
            $mail->addReplyTo($receive_email_to);
            $mail->setFrom($send_email_from);
            $mail->addAddress($email);
            
            $mail->isHTML(true);
            $mail->Subject = $et_subject;
  
            $mail->Body = $message;
            $mail->send();

            $success_message = 'A confirmation link is sent to your email address. You will get the password reset information in there.';

        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Forget Password</title>
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
                        <h4>Forget Password?</h4>
                        <p>You can send request to reset your password</p>
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
                            <label for="exampleInputEmail">Email address</label>
                            <input type="email" id="exampleInputEmail" name="email" autocomplete="off">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>                        
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name="form1">Submit <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="row mb-4 rmber-area mt-3">
                            <div class="col-12 text-center">
                                <a href="login.php">Back to login page</a>
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