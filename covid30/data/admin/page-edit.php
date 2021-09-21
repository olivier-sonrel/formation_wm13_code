<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $page_name        = sanitize_string($_POST['page_name']);
    $page_slug        = sanitize_string($_POST['page_slug']);
    $page_content     = sanitize_ckeditor($_POST['page_content']);
    $page_layout      = sanitize_string($_POST['page_layout']);
    $status           = sanitize_string($_POST['status']);
    $meta_title       = sanitize_string($_POST['meta_title']);
    $meta_description = sanitize_string($_POST['meta_description']);
    

    $valid = 1;

    if($page_name == '')
    {
        $valid = 0;
        $error_message .= 'Page Name can not be empty<br>';
    } else {
        // Duplicate Page checking
        // current page name that is in the database
        $statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_id=?");
        $statement->execute(array($_REQUEST['id']));
        $result = $statement->fetchAll();
        foreach($result as $row) {
            $current_page_name = $row['page_name'];
        }

        $statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_name=? and page_name!=?");
        $statement->execute(array($page_name,$current_page_name));
        $total = $statement->rowCount();                            
        if($total) {
            $valid = 0;
            $error_message .= 'Page name already exists<br>';
        }
    }
   

    if($valid == 1) 
    {
        if($page_slug == '') {
            // generate slug
            $temp_string = strtolower($page_name);
            $page_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);;
        } else {
            $temp_string = strtolower($page_slug);
            $page_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
        }

        // if slug already exists, then rename it
        $statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_slug=? AND page_name!=?");
        $statement->execute(array($page_slug,$current_page_name));
        $total = $statement->rowCount();
        if($total) {
            $page_slug = $page_slug.'-1';
        }

        $statement = $pdo->prepare("UPDATE tbl_page SET  
                    page_name=?,
                    page_slug=?,
                    page_content=?,
                    page_layout=?,
                    status=?,
                    meta_title=?,
                    meta_description=?
                    WHERE page_id=?
                ");
        $statement->execute(array(
                    $page_name,
                    $page_slug,
                    $page_content,
                    $page_layout,
                    $status,
                    $meta_title,
                    $meta_description,
                    $_REQUEST['id']
                ));
        
        $success_message = 'Page information is updated successfully!';
    }    
}


if(isset($_POST['form2']))
{
    $valid = 1;

    $path = $_FILES['banner']['name'];
    $path_tmp = $_FILES['banner']['tmp_name'];

    $current_banner = sanitize_string($_POST['current_banner']);

    if($path == '') 
    {
        $valid = 0;
        $error_message .= 'You must have to select a photo for banner<br>';
    }
    else
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $path_tmp);
        if( $mime != 'image/jpeg' && $mime != 'image/png' && $mime != 'image/gif' )
        {
            $valid = 0;
            $error_message .= 'Only jpg, png or gif file is allowed for banner<br>';
        }
    }

    if($valid == 1) 
    {
        if($mime == 'image/jpeg') {$ext = 'jpg';}
        elseif($mime == 'image/png') {$ext = 'png';}
        elseif($mime == 'image/gif') {$ext = 'gif';}

        unlink('../uploads/'.$current_banner);

        $final_name = 'page-banner-'.$_REQUEST['id'].'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_page SET  
                    banner=? 
                    WHERE page_id=?
                ");
        $statement->execute(array(
                    $final_name,
                    $_REQUEST['id']
                ));

        $success_message = 'Page banner is updated successfully!';
    }    
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Check the id is valid or not
    $statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_id=?");
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
                <h4 class="page-title pull-left">Edit Page</h4>
                <a href="page.php" class="btn btn-primary btn-xs">View Pages</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php                           
foreach ($result as $row) {
    $page_name        = $row['page_name'];
    $page_slug        = $row['page_slug'];
    $page_content     = $row['page_content'];
    $page_layout      = $row['page_layout'];
    $banner           = $row['banner'];
    $status           = $row['status'];
    $meta_title       = $row['meta_title'];
    $meta_description = $row['meta_description'];
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
                            <a class="nav-link" id="v-pills-tab-2" data-toggle="pill" href="#v-pills-t-2" role="tab" aria-controls="v-pills-t-2" aria-selected="false">Change Banner</a>
                        </div>

                        <div class="tab-content" id="v-pills-tabContent">

                            <div class="tab-pane fade show active" id="v-pills-t-1" role="tabpanel" aria-labelledby="v-pills-tab-1">
                                
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Page Name *</b></label>
                                        <input type="text" class="form-control" name="page_name" value="<?php echo safe_data($page_name); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Page Slug</b></label>
                                        <input type="text" class="form-control" name="page_slug" value="<?php echo safe_data($page_slug); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Page Layout *</b></label>
                                        <div class="d-block">

                                            <select class="form-control select2" name="page_layout" onChange="showContent1(this)">

                                                <option value="Full Width Page Layout" <?php if($page_layout=='Full Width Page Layout') {echo 'selected';} ?>>Full Width Page Layout</option>

                                                <option value="FAQ Page Layout" <?php if($page_layout=='FAQ Page Layout') {echo 'selected';} ?>>FAQ Page Layout</option>

                                                <option value="Prevention Page Layout" <?php if($page_layout=='Prevention Page Layout') {echo 'selected';} ?>>Prevention Page Layout</option>

                                                <option value="Doctor Page Layout" <?php if($page_layout=='Doctor Page Layout') {echo 'selected';} ?>>Doctor Page Layout</option>

                                                <option value="Photo Gallery Page Layout" <?php if($page_layout=='Photo Gallery Page Layout') {echo 'selected';} ?>>Photo Gallery Page Layout</option>
                                                
                                                <option value="Video Gallery Page Layout" <?php if($page_layout=='Video Gallery Page Layout') {echo 'selected';} ?>>Video Gallery Page Layout</option>
                                                
                                                <option value="News Page Layout" <?php if($page_layout=='News Page Layout') {echo 'selected';} ?>>News Page Layout</option>
                                                
                                                <option value="Contact Us Page Layout" <?php if($page_layout=='Contact Us Page Layout') {echo 'selected';} ?>>Contact Us Page Layout</option>

                                                <option value="Product Page Layout" <?php if($page_layout=='Product Page Layout') {echo 'selected';} ?>>Product Page Layout</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="showPageContentTextarea">
                                        <div class="form-group">
                                            <label for=""><b class="text-muted d-block">Page Content</b></label>
                                            <textarea class="form-control editor" name="page_content"><?php echo safe_data($page_content); ?></textarea>
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
                                    <input type="hidden" name="current_banner" value="<?php echo safe_data($banner); ?>">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Existing Banner</b></label>
                                        <div class="d-block">
                                            <img src="../uploads/<?php echo safe_data($banner); ?>" class="w_400">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Change Banner</b></label>
                                        <div class="d-block">
                                            <input type="file" name="banner"><br>
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

<script>
<?php if($page_layout == 'Full Width Page Layout'): ?>
    document.getElementById('showPageContentTextarea').style.display = "block";
<?php else: ?>
    document.getElementById('showPageContentTextarea').style.display = "none";    
<?php endif; ?>
function showContent1(elem)
{
    if( elem.value != 'Full Width Page Layout') 
    {
        document.getElementById('showPageContentTextarea').style.display = "none";
    }
    else
    {
        document.getElementById('showPageContentTextarea').style.display = "block";
    }
}
</script>

<?php require_once('footer.php'); ?>