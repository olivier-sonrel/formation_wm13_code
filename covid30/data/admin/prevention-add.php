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

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

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
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        $statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_prevention'");
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

        $final_name = 'prevention-'.$ai_id.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );
    
        $statement = $pdo->prepare("INSERT INTO tbl_prevention (
                            name,
                            slug,
                            description,
                            short_description,
                            photo,
                            meta_title,
                            meta_description,
                            prevention_order,
                            status
                        ) VALUES (?,?,?,?,?,?,?,?,?)");
        $statement->execute(array(
                            $name,
                            $slug,
                            $description,
                            $short_description,
                            $final_name,
                            $meta_title,
                            $meta_description,
                            $prevention_order,
                            $status
                        ));
            
        $success_message = 'Prevention is added successfully!';
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Add Prevention</h4>
                <a href="prevention.php" class="btn btn-primary btn-xs">View Preventions</a>
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
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Name *</b></label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Slug</b></label>
                            <input type="text" class="form-control" name="slug">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Short Description *</b></label>
                            <textarea class="form-control h_100" name="short_description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Description *</b></label>
                            <textarea class="form-control editor" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Meta Title</b></label>
                            <input type="text" class="form-control" name="meta_title">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Meta Description</b></label>
                            <textarea class="form-control h_100" name="meta_description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Photo *</b></label>
                            <div class="d-block">
                                <input type="file" name="photo"><br>
                                <span class="text-danger">(Only jpg, jpeg, gif and png are allowed)</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Order</b></label>
                            <input type="text" class="form-control" name="prevention_order">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Status</b></label>
                            <div class="d-block">
                                <select name="status" class="form-control select2">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
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