<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
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
        $statement = $pdo->prepare("SELECT * FROM tbl_setting_logo WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $logo = $row['logo'];
            unlink('../uploads/'.$logo);
        }

        // updating the data
        $final_name = 'logo'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_setting_logo SET logo=? WHERE id=1");
        $statement->execute(array($final_name));

        $success_message = 'Logo is updated successfully.';
        
    }
}


if(isset($_POST['form2']))
{
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path == '') 
    {
        $valid = 0;
        $error_message1 .= 'You must have to select a photo<br>';
    }
    else
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' )
        {
            $valid = 0;
            $error_message1 .= 'Only jpg, png or gif file is allowed for photo<br>';
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
        $statement = $pdo->prepare("SELECT * FROM tbl_setting_logo WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll();                           
        foreach ($result as $row) {
            $logo_admin = $row['logo_admin'];
            unlink('../uploads/'.$logo_admin);
        }

        // updating the data
        $final_name = 'logo_admin'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_setting_logo SET logo_admin=? WHERE id=1");
        $statement->execute(array($final_name));

        $success_message1 = 'Admin Logo is updated successfully.';
        
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Setting - Logo</h4>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_setting_logo WHERE id=1");
$statement->execute();
$result = $statement->fetchAll();                           
foreach ($result as $row) {
    $logo = $row['logo'];
    $logo_admin = $row['logo_admin'];
}
?>


<div class="main-content-inner">
    <div class="row">

        <div class="col-6 mt-5">
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

                    <h4 class="header-title">Front End Logo</h4>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($logo); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form1">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-6 mt-5">
            <div class="card">
                <div class="card-body">

                    <?php
                    if( (isset($error_message1)) && ($error_message1!='') ):
                        echo '<div class="alert-items"><div class="alert alert-danger" role="alert"><b>';
                        echo safe_data($error_message1);
                        echo '</b></div></div>';
                    endif;

                    if( (isset($success_message1)) && ($success_message1!='') ):
                        echo '<div class="alert-items"><div class="alert alert-success" role="alert"><b>';
                        echo safe_data($success_message1);
                        echo '</b></div></div>';
                    endif;
                    ?>

                    <h4 class="header-title">Admin Logo</h4>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                            <div class="d-block">
                                <img src="../uploads/<?php echo safe_data($logo_admin); ?>" class="h_100 bg_f3f3f3 p-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Change Photo</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>
</div>

<?php require_once('footer.php'); ?>