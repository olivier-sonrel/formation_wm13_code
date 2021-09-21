<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $heading     = sanitize_string($_POST['heading']);
    $content     = sanitize_string($_POST['content']);
    $button_text = sanitize_string($_POST['button_text']);
    $button_url  = sanitize_url($_POST['button_url']);
    $slide_order = sanitize_int($_POST['slide_order']);
    $status      = sanitize_string($_POST['status']);
   
    $statement = $pdo->prepare("UPDATE tbl_slider SET  
                    heading=?, 
                    content=?, 
                    button_text=?, 
                    button_url=?, 
                    slide_order=?, 
                    status=? 
                    WHERE id=?
                ");
    $statement->execute(array(
                    $heading,
                    $content,
                    $button_text,
                    $button_url,
                    $slide_order,
                    $status,
                    $_REQUEST['id']
                ));
        
    $success_message = 'Slider information is updated successfully!';
}


if(isset($_POST['form2']))
{
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    $current_photo = sanitize_string($_POST['current_photo']);

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

        unlink('../uploads/'.$current_photo);

        $final_name = 'slider-'.$_REQUEST['id'].'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_slider SET  
                    photo=? 
                    WHERE id=?
                ");
        $statement->execute(array(
                    $final_name,
                    $_REQUEST['id']
                ));

        $success_message = 'Slider photo is updated successfully!';
    }    
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM tbl_slider WHERE id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    $result = $statement->fetchAll();
    if( $total == 0 ) {
        header('location: logout.php');
        exit;
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Edit Slider</h4>
                <a href="slider.php" class="btn btn-primary btn-xs">View Sliders</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_slider WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll();
foreach ($result as $row) {
    $photo       = $row['photo'];
    $heading     = $row['heading'];
    $content     = $row['content'];
    $button_text = $row['button_text'];
    $button_url  = $row['button_url'];
    $slide_order = $row['slide_order'];
    $status      = $row['status'];
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

                    <div class="d-md-flex arf-vertical-tab">

                        <div class="nav flex-column nav-pills mr-4 mb-3 mb-sm-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-info-tab" data-toggle="pill" href="#v-pills-info" role="tab" aria-controls="v-pills-info" aria-selected="true">Change Information</a>
                            <a class="nav-link" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">Change Photo</a>
                        </div>

                        <div class="tab-content" id="v-pills-tabContent">

                            <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel" aria-labelledby="v-pills-info-tab">
                                
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Heading</b></label>
                                        <input type="text" class="form-control" name="heading" value="<?php echo safe_data($heading); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Content</b></label>
                                        <textarea class="form-control h_100" name="content"><?php echo safe_data($content); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Button Text</b></label>
                                        <input type="text" class="form-control" name="button_text" value="<?php echo safe_data($button_text); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Button URL</b></label>
                                        <input type="text" class="form-control" name="button_url" value="<?php echo safe_data($button_url); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Order</b></label>
                                        <input type="text" class="form-control" name="slide_order" value="<?php echo safe_data($slide_order); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Status</b></label>
                                        <div class="d-block">
                                            <select name="status" class="form-control select2">
                                                <option value="Active" <?php if($status == 'Active') {echo 'selected';} ?>>Active</option>
                                                <option value="Inactive" <?php if($status == 'Inactive') {echo 'selected';} ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form1">Update</button>
                                    </div>
                                </form>
                                    
                            </div>

                            <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                                
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="current_photo" value="<?php echo safe_data($photo); ?>">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                                        <div class="d-block">
                                            <img src="../uploads/<?php echo safe_data($photo); ?>" class="w_400">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Photo</b></label>
                                        <div class="d-block">
                                            <input type="file" name="photo"><br>
                                            <span class="text-danger">(Only jpg, jpeg, gif and png are allowed)</span>
                                        </div>
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
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>