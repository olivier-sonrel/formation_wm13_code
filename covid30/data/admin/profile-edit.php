<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) 
{
    $valid = 1;

    $full_name = sanitize_string($_POST['full_name']);
    $email = sanitize_email($_POST['email']);

    if(empty($full_name)) {
        $valid = 0;
        $error_message .= "Name can not be empty<br>";
    }
    if(empty($email)) {
        $valid = 0;
        $error_message .= 'Email address can not be empty<br>';
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $valid = 0;
            $error_message .= 'Email address must be valid<br>';
        } else {
            // current email address that is in the database
            $statement = $pdo->prepare("SELECT * FROM tbl_user WHERE id=?");
            $statement->execute(array($_SESSION['user']['id']));
            $result = $statement->fetchAll();
            foreach($result as $row) {
                $current_email = $row['email'];
            }

            $statement = $pdo->prepare("SELECT * FROM tbl_user WHERE email=? and email!=?");
            $statement->execute(array($email,$current_email));
            $total = $statement->rowCount();                            
            if($total) {
                $valid = 0;
                $error_message .= 'Email address already exists<br>';
            }
        }
    }

    if($valid == 1) {
        
        $_SESSION['user']['full_name'] = $full_name;
        $_SESSION['user']['email'] = $email;

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_user SET full_name=?, email=? WHERE id=?");
        $statement->execute(array($full_name,$email,$_SESSION['user']['id']));

        $success_message = 'Profile Information is updated successfully.';
    }
}


if(isset($_POST['form2'])) 
{
    $valid = 1;

    $password = sanitize_string($_POST['password']);
    $re_password = sanitize_string($_POST['re_password']);

    if( empty($password) || empty($re_password) ) {
        $valid = 0;
        $error_message .= "Password can not be empty<br>";
    }

    if( !empty($password) && !empty($re_password) ) {
        if($password != $re_password) {
            $valid = 0;
            $error_message .= "Passwords do not match<br>"; 
        }        
    }

    if($valid == 1) {

        $final_password = password_hash($password, PASSWORD_DEFAULT);

        $_SESSION['user']['password'] = $final_password;

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_user SET password=? WHERE id=?");
        $statement->execute(array($final_password,$_SESSION['user']['id']));

        $success_message = 'Profile Password is updated successfully.';
    }
}



if(isset($_POST['form3'])) 
{
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path == '') 
    {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } 
    else 
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' )
        {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }

    if($valid == 1) 
    {

        if($mime == 'image/jpeg')
        {
            $ext = 'jpg';
        }
        elseif($mime == 'image/png')
        {
            $ext = 'png';
        }
        elseif($mime == 'image/gif')
        {
            $ext = 'gif';
        }

        // removing the existing photo
        unlink('../uploads/'.$_SESSION['user']['photo']);

        // updating the data
        $final_name = 'user-'.$_SESSION['user']['id'].'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );
        $_SESSION['user']['photo'] = $final_name;

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_user SET photo=? WHERE id=?");
        $statement->execute(array($final_name,$_SESSION['user']['id']));

        $success_message = 'Profile Photo is updated successfully.';
        
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Edit Profile</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="index.php">Home</a></li>
                    <li><span>Edit Profile</span></li>
                </ul>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>


<div class="main-content-inner">
    <div class="row">

        
        <div class="col-lg-12 mt-5">
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

                    <div class="d-md-flex arf-vertical-tab">

                        <div class="nav flex-column nav-pills mr-4 mb-3 mb-sm-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-info-tab" data-toggle="pill" href="#v-pills-info" role="tab" aria-controls="v-pills-info" aria-selected="true">Change Information</a>
                            <a class="nav-link" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">Change Password</a>
                            <a class="nav-link" id="v-pills-photo-tab" data-toggle="pill" href="#v-pills-photo" role="tab" aria-controls="v-pills-photo" aria-selected="false">Change Photo</a>
                        </div>

                        <div class="tab-content" id="v-pills-tabContent">

                            <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel" aria-labelledby="v-pills-info-tab">
                                
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Full Name</b></label>
                                        <input type="text" class="form-control" name="full_name" value="<?php echo safe_data($_SESSION['user']['full_name']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Email Address</b></label>
                                        <input type="email" class="form-control" name="email" value="<?php echo safe_data($_SESSION['user']['email']); ?>">
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form1">Update</button>
                                    </div>
                                </form>
                                    
                            </div>

                            <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                                
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Password</b></label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Retype Password</b></label>
                                        <input type="password" class="form-control" name="re_password">
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form2">Update</button>
                                    </div>
                                </form>
                                    
                            </div>

                            <div class="tab-pane fade" id="v-pills-photo" role="tabpanel" aria-labelledby="v-pills-photo-tab">
                                
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                                        <div class="d-block">
                                            <img src="../uploads/<?php echo safe_data($_SESSION['user']['photo']); ?>" alt="Photo" class="w_200">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Change Photo</b></label>
                                        <div class="d-block">
                                            <input type="file" name="photo">
                                        </div>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form3">Update</button>
                                    </div>
                                </form>
                                    
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        
        

    </div>
</div>

<?php require_once('footer.php'); ?>