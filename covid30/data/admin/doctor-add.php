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
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_doctor'");
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row) {
            $ai_id=$row[10];
        }

        if($slug == '') {
            $temp_string = strtolower($name);
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
        } else {
            $temp_string = strtolower($slug);
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
        }

        $final_name = 'doctor-'.$ai_id.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("INSERT INTO tbl_doctor (
                            name,
                            slug,
                            designation,
                            degree,
                            detail,
                            practice_location,
                            advice,
                            facebook,
                            twitter,
                            linkedin,
                            youtube,
                            instagram,
                            email,
                            phone,
                            website,
                            address,
                            video_youtube,
                            photo,
                            doctor_order,
                            status,
                            meta_title,
                            meta_description
                        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
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
                            $final_name,
                            $doctor_order,
                            $status,
                            $meta_title,
                            $meta_description
                        ));
            
        $success_message = 'Doctor is added successfully!';
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Add Doctor</h4>
                <a href="doctor.php" class="btn btn-primary btn-xs">View Doctors</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>


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

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Name *</b></label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Slug</b></label>
                                    <input type="text" class="form-control" name="slug">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Designation *</b></label>
                            <input type="text" class="form-control" name="designation">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Degree</b></label>
                                    <textarea class="form-control editor" name="degree"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Detail</b></label>
                                    <textarea class="form-control editor" name="detail"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Practice Location</b></label>
                                    <textarea class="form-control editor" name="practice_location"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Advice</b></label>
                                    <textarea class="form-control editor" name="advice"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Facebook</b></label>
                                    <input type="text" class="form-control" name="facebook">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Twitter</b></label>
                                    <input type="text" class="form-control" name="twitter">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Linkedin</b></label>
                                    <input type="text" class="form-control" name="linkedin">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">YouTube</b></label>
                                    <input type="text" class="form-control" name="youtube">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Instagram</b></label>
                                    <input type="text" class="form-control" name="instagram">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Email Address</b></label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Phone</b></label>
                                    <input type="text" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Website</b></label>
                                    <input type="text" class="form-control" name="website">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Video (Youtube ID)</b></label>
                                    <input type="text" class="form-control" name="video_youtube">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Address</b></label>
                                    <textarea class="form-control h_100" name="address"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Photo *</b></label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                            
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Order</b></label>
                                    <input type="text" class="form-control" name="doctor_order">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Status</b></label>
                                    <select name="status" class="form-control select2">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Meta Title</b></label>
                            <input type="text" class="form-control" name="meta_title">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Meta Description</b></label>
                            <textarea class="form-control h_100" name="meta_description"></textarea>
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form1">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>