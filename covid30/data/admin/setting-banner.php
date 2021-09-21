<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form_banner_prevention_detail']))
{
    $valid = 1;
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];
    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' ) {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }
    if($valid == 1) {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $banner_prevention_detail = $row['banner_prevention_detail'];
            unlink('../uploads/'.$banner_prevention_detail);
        }
        $final_name = 'banner_prevention_detail'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_setting_banner SET banner_prevention_detail=? WHERE id=1");
        $statement->execute(array($final_name));
        $success_message = 'Banner (Prevention Detail) is updated successfully.';        
    }
}

if(isset($_POST['form_banner_doctor_detail']))
{
    $valid = 1;
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];
    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' ) {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }
    if($valid == 1) {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $banner_doctor_detail = $row['banner_doctor_detail'];
            unlink('../uploads/'.$banner_doctor_detail);
        }
        $final_name = 'banner_doctor_detail'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_setting_banner SET banner_doctor_detail=? WHERE id=1");
        $statement->execute(array($final_name));
        $success_message = 'Banner (Doctor Detail) is updated successfully.';        
    }
}

if(isset($_POST['form_banner_news_detail']))
{
    $valid = 1;
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];
    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' ) {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }
    if($valid == 1) {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $banner_news_detail = $row['banner_news_detail'];
            unlink('../uploads/'.$banner_news_detail);
        }
        $final_name = 'banner_news_detail'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_setting_banner SET banner_news_detail=? WHERE id=1");
        $statement->execute(array($final_name));
        $success_message = 'Banner (News Detail) is updated successfully.';        
    }
}

if(isset($_POST['form_banner_category_detail']))
{
    $valid = 1;
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];
    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' ) {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }
    if($valid == 1) {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $banner_category_detail = $row['banner_category_detail'];
            unlink('../uploads/'.$banner_category_detail);
        }
        $final_name = 'banner_category_detail'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_setting_banner SET banner_category_detail=? WHERE id=1");
        $statement->execute(array($final_name));
        $success_message = 'Banner (Category Detail) is updated successfully.';        
    }
}

if(isset($_POST['form_banner_search']))
{
    $valid = 1;
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];
    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' ) {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }
    if($valid == 1) {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $banner_search = $row['banner_search'];
            unlink('../uploads/'.$banner_search);
        }
        $final_name = 'banner_search'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_setting_banner SET banner_search=? WHERE id=1");
        $statement->execute(array($final_name));
        $success_message = 'Banner (Search Result Page) is updated successfully.';        
    }
}

if(isset($_POST['form_banner_product_detail']))
{
    $valid = 1;
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];
    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' ) {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }
    if($valid == 1) {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $banner_product_detail = $row['banner_product_detail'];
            unlink('../uploads/'.$banner_product_detail);
        }
        $final_name = 'banner_product_detail'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_setting_banner SET banner_product_detail=? WHERE id=1");
        $statement->execute(array($final_name));
        $success_message = 'Banner (Product Detail Page) is updated successfully.';        
    }
}


if(isset($_POST['form_banner_cart']))
{
    $valid = 1;
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];
    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' ) {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }
    if($valid == 1) {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $banner_cart = $row['banner_cart'];
            unlink('../uploads/'.$banner_cart);
        }
        $final_name = 'banner_cart'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_setting_banner SET banner_cart=? WHERE id=1");
        $statement->execute(array($final_name));
        $success_message = 'Banner (Cart Page) is updated successfully.';        
    }
}


if(isset($_POST['form_banner_checkout']))
{
    $valid = 1;
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];
    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' ) {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }
    if($valid == 1) {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $banner_checkout = $row['banner_checkout'];
            unlink('../uploads/'.$banner_checkout);
        }
        $final_name = 'banner_checkout'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_setting_banner SET banner_checkout=? WHERE id=1");
        $statement->execute(array($final_name));
        $success_message = 'Banner (Checkout Page) is updated successfully.';        
    }
}



if(isset($_POST['form_banner_login']))
{
    $valid = 1;
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];
    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' ) {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }
    if($valid == 1) {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $banner_login = $row['banner_login'];
            unlink('../uploads/'.$banner_login);
        }
        $final_name = 'banner_login'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_setting_banner SET banner_login=? WHERE id=1");
        $statement->execute(array($final_name));
        $success_message = 'Banner (Login Page) is updated successfully.';        
    }
}



if(isset($_POST['form_banner_registration']))
{
    $valid = 1;
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];
    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' ) {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }
    if($valid == 1) {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $banner_registration = $row['banner_registration'];
            unlink('../uploads/'.$banner_registration);
        }
        $final_name = 'banner_registration'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_setting_banner SET banner_registration=? WHERE id=1");
        $statement->execute(array($final_name));
        $success_message = 'Banner (Registration Page) is updated successfully.';        
    }
}



if(isset($_POST['form_banner_forget_password']))
{
    $valid = 1;
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];
    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' ) {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }
    if($valid == 1) {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $banner_forget_password = $row['banner_forget_password'];
            unlink('../uploads/'.$banner_forget_password);
        }
        $final_name = 'banner_forget_password'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_setting_banner SET banner_forget_password=? WHERE id=1");
        $statement->execute(array($final_name));
        $success_message = 'Banner (Forget Password Page) is updated successfully.';        
    }
}


if(isset($_POST['form_banner_customer_panel']))
{
    $valid = 1;
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];
    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' ) {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for photo<br>';
        }
    }
    if($valid == 1) {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $banner_customer_panel = $row['banner_customer_panel'];
            unlink('../uploads/'.$banner_customer_panel);
        }
        $final_name = 'banner_customer_panel'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_setting_banner SET banner_customer_panel=? WHERE id=1");
        $statement->execute(array($final_name));
        $success_message = 'Banner (Customer Panel Page) is updated successfully.';        
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Setting - Banner</h4>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=1");
$statement->execute();
$result = $statement->fetchAll();                           
foreach ($result as $row) {
    $banner_prevention_detail = $row['banner_prevention_detail'];
    $banner_doctor_detail = $row['banner_doctor_detail'];
    $banner_news_detail = $row['banner_news_detail'];
    $banner_category_detail = $row['banner_category_detail'];
    $banner_search = $row['banner_search'];
    $banner_product_detail = $row['banner_product_detail'];
    $banner_cart = $row['banner_cart'];
    $banner_checkout = $row['banner_checkout'];
    $banner_login = $row['banner_login'];
    $banner_registration = $row['banner_registration'];
    $banner_forget_password = $row['banner_forget_password'];
    $banner_customer_panel = $row['banner_customer_panel'];
}
?>


<div class="main-content-inner">
    <div class="row">

        <div class="col-md-12 mt-5">            
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
        </div>

        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Banner (Prevention Detail Page)</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($banner_prevention_detail); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_banner_prevention_detail">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Banner (Doctor Detail Page)</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($banner_doctor_detail); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_banner_doctor_detail">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Banner (News Detail Page)</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($banner_news_detail); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_banner_news_detail">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Banner (Category Detail Page)</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($banner_category_detail); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_banner_category_detail">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Banner (Search Result Page)</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($banner_search); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_banner_search">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Banner (Product Detail Page)</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($banner_product_detail); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_banner_product_detail">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Banner (Cart Page)</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($banner_cart); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_banner_cart">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Banner (Checkout Page)</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($banner_checkout); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_banner_checkout">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Banner (Login Page)</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($banner_login); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_banner_login">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Banner (Registration Page)</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($banner_registration); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_banner_registration">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Banner (Forget Password Page)</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($banner_forget_password); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_banner_forget_password">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Banner (Customer Panel Pages)</h4>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($banner_customer_panel); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_banner_customer_panel">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>
</div>

<?php require_once('footer.php'); ?>