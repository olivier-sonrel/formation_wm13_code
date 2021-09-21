<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $name              = sanitize_string($_POST['name']);
    $slug              = sanitize_string($_POST['slug']);
    $designation       = sanitize_string($_POST['designation']);
    $degree            = sanitize_ckeditor($_POST['degree']);
    $detail            = sanitize_ckeditor($_POST['detail']);
    $practice_location = sanitize_ckeditor($_POST['practice_location']);
    $advice            = sanitize_ckeditor($_POST['advice']);
    $facebook          = sanitize_string($_POST['facebook']);
    $twitter           = sanitize_string($_POST['twitter']);
    $linkedin          = sanitize_string($_POST['linkedin']);
    $youtube           = sanitize_string($_POST['youtube']);
    $instagram         = sanitize_string($_POST['instagram']);
    $email             = sanitize_email($_POST['email']);
    $phone             = sanitize_string($_POST['phone']);
    $website           = sanitize_string($_POST['website']);
    $address           = sanitize_string($_POST['address']);
    $video_youtube     = sanitize_string($_POST['video_youtube']);
    $doctor_order      = sanitize_string($_POST['doctor_order']);
    $status            = sanitize_string($_POST['status']);
    $meta_title        = sanitize_string($_POST['meta_title']);
    $meta_description  = sanitize_string($_POST['meta_description']);

    $valid = 1;

    if($name == '')
    {
        $valid = 0;
        $error_message .= 'Name can not be empty<br>';
    }
    if($designation == '')
    {
        $valid = 0;
        $error_message .= 'Designation can not be empty<br>';
    }

    if($valid == 1)
    {
        $statement = $pdo->prepare("SELECT * FROM tbl_doctor WHERE id=?");
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
        $statement = $pdo->prepare("SELECT * FROM tbl_doctor WHERE slug=? AND name!=?");
        $statement->execute(array($slug,$current_name));
        $total = $statement->rowCount();
        if($total) {
            $slug = $slug.'-1';
        }

        $statement = $pdo->prepare("UPDATE tbl_doctor SET  
                    name=?, 
                    slug=?, 
                    designation=?, 
                    degree=?, 
                    detail=?, 
                    practice_location=?,
                    advice=?,
                    facebook=?,
                    twitter=?,
                    linkedin=?,
                    youtube=?,
                    instagram=?,
                    email=?,
                    phone=?,
                    website=?,
                    address=?,
                    video_youtube=?,
                    doctor_order=?, 
                    status=?, 
                    meta_title=?, 
                    meta_description=?
                    WHERE id=?
                ");
        $statement->execute(array(
                    $name,
                    $slug,
                    $designation,
                    $degree,
                    $detail,
                    $practice_location,
                    $advice,
                    $facebook,
                    $twitter,
                    $linkedin,
                    $youtube,
                    $instagram,
                    $email,
                    $phone,
                    $website,
                    $address,
                    $video_youtube,
                    $doctor_order,
                    $status,
                    $meta_title,
                    $meta_description,
                    $_REQUEST['id']
                ));
        $success_message = 'Doctor information is updated successfully!';
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

        $final_name = 'doctor-'.$_REQUEST['id'].'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_doctor SET  
                    photo=? 
                    WHERE id=?
                ");
        $statement->execute(array(
                    $final_name,
                    $_REQUEST['id']
                ));

        $success_message = 'Doctor photo is updated successfully!';
    }    
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM tbl_doctor WHERE id=?");
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
                <h4 class="page-title pull-left">Edit Doctor</h4>
                <a href="doctor.php" class="btn btn-primary btn-xs">View Doctors</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_doctor WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll();
foreach ($result as $row) {
    $name              = $row['name'];
    $slug              = $row['slug'];
    $designation       = $row['designation'];
    $degree            = $row['degree'];
    $detail            = $row['detail'];
    $practice_location = $row['practice_location'];
    $advice            = $row['advice'];
    $facebook          = $row['facebook'];
    $twitter           = $row['twitter'];
    $linkedin          = $row['linkedin'];
    $youtube           = $row['youtube'];
    $instagram         = $row['instagram'];
    $email             = $row['email'];
    $phone             = $row['phone'];
    $website           = $row['website'];
    $address           = $row['address'];
    $video_youtube      = $row['video_youtube'];
    $photo             = $row['photo'];
    $doctor_order      = $row['doctor_order'];
    $status            = $row['status'];
    $meta_title        = $row['meta_title'];
    $meta_description  = $row['meta_description'];
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Name *</b></label>
                                                <input type="text" class="form-control" name="name" value="<?php echo safe_data($name); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Slug</b></label>
                                                <input type="text" class="form-control" name="slug" value="<?php echo safe_data($slug); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Designation *</b></label>
                                        <input type="text" class="form-control" name="designation" value="<?php echo safe_data($designation); ?>">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Degree</b></label>
                                                <textarea class="form-control editor" name="degree"><?php echo safe_data($degree); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Detail</b></label>
                                                <textarea class="form-control editor" name="detail"><?php echo safe_data($detail); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Practice Location</b></label>
                                                <textarea class="form-control editor" name="practice_location"><?php echo safe_data($practice_location); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Advice</b></label>
                                                <textarea class="form-control editor" name="advice"><?php echo safe_data($advice); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Facebook</b></label>
                                                <input type="text" class="form-control" name="facebook" value="<?php echo safe_data($facebook); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Twitter</b></label>
                                                <input type="text" class="form-control" name="twitter" value="<?php echo safe_data($twitter); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Linkedin</b></label>
                                                <input type="text" class="form-control" name="linkedin" value="<?php echo safe_data($linkedin); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">YouTube</b></label>
                                                <input type="text" class="form-control" name="youtube" value="<?php echo safe_data($youtube); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Instagram</b></label>
                                                <input type="text" class="form-control" name="instagram" value="<?php echo safe_data($instagram); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Email Address</b></label>
                                                <input type="text" class="form-control" name="email" value="<?php echo safe_data($email); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Phone</b></label>
                                                <input type="text" class="form-control" name="phone" value="<?php echo safe_data($phone); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Website</b></label>
                                                <input type="text" class="form-control" name="website" value="<?php echo safe_data($website); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Existing Video Preview</b></label>
                                        <div class="d-block admin_iframe_view_1">
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo safe_data($video_youtube); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Video (Youtube ID)</b></label>
                                                <input type="text" class="form-control" name="video_youtube" value="<?php echo safe_data($video_youtube); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Address</b></label>
                                                <textarea class="form-control h_100" name="address"><?php echo safe_data($address); ?></textarea>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Order</b></label>
                                                <input type="text" class="form-control" name="doctor_order" value="<?php echo safe_data($doctor_order); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><b class="text-muted d-block">Status</b></label>
                                                <select name="status" class="form-control select2">
                                                    <option value="Active" <?php if($status == 'Active') {echo 'selected';} ?>>Active</option>
                                                    <option value="Inactive" <?php if($status == 'Inactive') {echo 'selected';} ?>>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Meta Title</b></label>
                                        <input type="text" class="form-control" name="meta_title" value="<?php echo safe_data($meta_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Meta Description</b></label>
                                        <textarea class="form-control h_100" name="meta_description"><?php echo safe_data($meta_description); ?></textarea>
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
                                            <img src="../uploads/<?php echo safe_data($photo); ?>" class="w_300">
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