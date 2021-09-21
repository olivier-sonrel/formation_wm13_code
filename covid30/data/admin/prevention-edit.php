<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $name              = sanitize_string($_POST['name']);
    $slug              = sanitize_string($_POST['slug']);
    $short_description = sanitize_string($_POST['short_description']);
    $description       = sanitize_ckeditor($_POST['description']);
    $meta_title        = sanitize_string($_POST['meta_title']);
    $meta_description  = sanitize_string($_POST['meta_description']);
    $prevention_order  = sanitize_int($_POST['prevention_order']);
    $status            = sanitize_string($_POST['status']);

    $valid = 1;

    if($name == '')
    {
        $valid = 0;
        $error_message .= 'Name can not be empty<br>';
    }

    if($short_description == '')
    {
        $valid = 0;
        $error_message .= 'Short Description can not be empty<br>';
    }

    if($description == '')
    {
        $valid = 0;
        $error_message .= 'Description can not be empty<br>';
    }

    if($valid == 1) 
    {

        $statement = $pdo->prepare("SELECT * FROM tbl_prevention WHERE id=?");
        $statement->execute(array($_REQUEST['id']));
        $result = $statement->fetchAll();
        foreach($result as $row) {
            $current_name = $row['name'];
        }

        if($slug == '') {
            // generate slug
            $temp_string = strtolower($name);
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);;
        } else {
            $temp_string = strtolower($slug);
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
        }

        // if slug already exists, then rename it
        $statement = $pdo->prepare("SELECT * FROM tbl_prevention WHERE slug=? AND name!=?");
        $statement->execute(array($slug,$current_name));
        $total = $statement->rowCount();
        if($total) {
            $slug = $slug.'-1';
        }

        $statement = $pdo->prepare("UPDATE tbl_prevention SET  
                    name=?, 
                    slug=?, 
                    description=?, 
                    short_description=?, 
                    meta_title=?, 
                    meta_description=?, 
                    prevention_order=?, 
                    status=? 
                    WHERE id=?
                ");
        $statement->execute(array(
                    $name,
                    $slug,
                    $description,
                    $short_description,
                    $meta_title,
                    $meta_description,
                    $prevention_order,
                    $status,
                    $_REQUEST['id']
                ));
        
        $success_message = 'Prevention information is updated successfully!';
    }    
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
        $error_message .= 'You must have to select a photo for featured photo<br>';
    }
    else
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' )
        {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for featured photo<br>';
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

        $final_name = 'prevention-'.$_REQUEST['id'].'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_prevention SET  
                    photo=? 
                    WHERE id=?
                ");
        $statement->execute(array(
                    $final_name,
                    $_REQUEST['id']
                ));

        $success_message = 'Prevention photo is updated successfully!';
    }    
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM tbl_prevention WHERE id=?");
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
                <h4 class="page-title pull-left">Edit Prevention</h4>
                <a href="prevention.php" class="btn btn-primary btn-xs">View Preventions</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_prevention WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll();
foreach ($result as $row) {
    $name              = $row['name'];
    $slug              = $row['slug'];
    $description       = $row['description'];
    $short_description = $row['short_description'];
    $photo             = $row['photo'];
    $meta_title        = $row['meta_title'];
    $meta_description  = $row['meta_description'];
    $prevention_order  = $row['prevention_order'];
    $status            = $row['status'];
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
                            <a class="nav-link active" id="v-pills-tab-1" data-toggle="pill" href="#v-pills-t-1" role="tab" aria-controls="v-pills-t-1" aria-selected="true">Change Information</a>
                            <a class="nav-link" id="v-pills-tab-2" data-toggle="pill" href="#v-pills-t-2" role="tab" aria-controls="v-pills-t-2" aria-selected="false">Change Photo</a>
                        </div>

                        <div class="tab-content" id="v-pills-tabContent">

                            <div class="tab-pane fade show active" id="v-pills-t-1" role="tabpanel" aria-labelledby="v-pills-tab-1">
                                
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Name *</b></label>
                                        <input type="text" class="form-control" name="name" value="<?php echo safe_data($name); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Slug</b></label>
                                        <input type="text" class="form-control" name="slug" value="<?php echo safe_data($slug); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Short Description *</b></label>
                                        <textarea class="form-control h_100" name="short_description"><?php echo safe_data($short_description); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Description *</b></label>
                                        <textarea class="form-control editor" name="description"><?php echo safe_data($description); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Meta Title</b></label>
                                        <input type="text" class="form-control" name="meta_title" value="<?php echo safe_data($meta_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Meta Description</b></label>
                                        <textarea class="form-control h_100" name="meta_description"><?php echo safe_data($meta_description); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Order</b></label>
                                        <input type="text" class="form-control" name="prevention_order" value="<?php echo safe_data($prevention_order); ?>">
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


                            <div class="tab-pane fade" id="v-pills-t-2" role="tabpanel" aria-labelledby="v-pills-tab-2">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="current_photo" value="<?php echo safe_data($photo); ?>">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                                        <div class="d-block">
                                            <img src="../uploads/<?php echo safe_data($photo); ?>" class="w_400">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Change Photo</b></label>
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