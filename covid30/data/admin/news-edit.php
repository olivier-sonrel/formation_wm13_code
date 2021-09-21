<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $news_title         = sanitize_string($_POST['news_title']);
    $news_slug          = sanitize_string($_POST['news_slug']);
    $news_content       = sanitize_ckeditor($_POST['news_content']);
    $news_content_short = sanitize_string($_POST['news_content_short']);
    $category_id        = sanitize_int($_POST['category_id']);
    $news_order         = sanitize_int($_POST['news_order']);
    $news_status        = sanitize_string($_POST['news_status']);
    $meta_title         = sanitize_string($_POST['meta_title']);
    $meta_description   = sanitize_string($_POST['meta_description']);

    $valid = 1;

    if($news_title == '')
    {
        $valid = 0;
        $error_message .= 'Title can not be empty<br>';
    }

    if($news_content == '')
    {
        $valid = 0;
        $error_message .= 'Content can not be empty<br>';
    }

    if($news_content_short == '')
    {
        $valid = 0;
        $error_message .= 'Short Content can not be empty<br>';
    }

    if($valid == 1) 
    {
        $statement = $pdo->prepare("SELECT * FROM tbl_news WHERE news_id=?");
        $statement->execute(array($_REQUEST['id']));
        $result = $statement->fetchAll();
        foreach($result as $row) {
            $current_title = $row['news_title'];
        }

        if($news_slug == '') {
            // generate slug
            $temp_string = strtolower($news_title);
            $news_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);;
        } else {
            $temp_string = strtolower($news_slug);
            $news_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
        }

        // if slug already exists, then rename it
        $statement = $pdo->prepare("SELECT * FROM tbl_news WHERE news_slug=? AND news_title!=?");
        $statement->execute(array($news_slug,$current_title));
        $total = $statement->rowCount();
        if($total) {
            $news_slug = $news_slug.'-1';
        }

        $statement = $pdo->prepare("UPDATE tbl_news SET  
                    news_title=?, 
                    news_slug=?, 
                    news_content=?, 
                    news_content_short=?, 
                    category_id=?, 
                    news_order=?, 
                    news_status=?,
                    meta_title=?,
                    meta_description=? 
                    WHERE news_id=?
                ");
        $statement->execute(array(
                    $news_title,
                    $news_slug,
                    $news_content,
                    $news_content_short,
                    $category_id,
                    $news_order,
                    $news_status,
                    $meta_title,
                    $meta_description,
                    $_REQUEST['id']
                ));
        
        $success_message = 'News information is updated successfully!';
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

        $final_name = 'news-'.$_REQUEST['id'].'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_news SET  
                    photo=? 
                    WHERE news_id=?
                ");
        $statement->execute(array(
                    $final_name,
                    $_REQUEST['id']
                ));

        $success_message = 'News photo is updated successfully!';
    }    
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM tbl_news WHERE news_id=?");
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
                <h4 class="page-title pull-left">Edit News</h4>
                <a href="news.php" class="btn btn-primary btn-xs">View News</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_news WHERE news_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll();
foreach ($result as $row) {
    $news_title         = $row['news_title'];
    $news_slug          = $row['news_slug'];
    $news_content       = $row['news_content'];
    $news_content_short = $row['news_content_short'];
    $news_date          = $row['news_date'];
    $photo              = $row['photo'];
    $category_id        = $row['category_id'];
    $news_order         = $row['news_order'];
    $news_status        = $row['news_status'];
    $meta_title         = $row['meta_title'];
    $meta_description   = $row['meta_description'];
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
                                        <label for=""><b class="text-muted d-block">Title *</b></label>
                                        <input type="text" class="form-control" name="news_title" value="<?php echo safe_data($news_title); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Slug</b></label>
                                        <input type="text" class="form-control" name="news_slug" value="<?php echo safe_data($news_slug); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Content *</b></label>
                                        <textarea class="form-control editor" name="news_content"><?php echo safe_data($news_content); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Short Content *</b></label>
                                        <textarea class="form-control h_100" name="news_content_short"><?php echo safe_data($news_content_short); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Select Category</b></label>
                                        <div class="d-block">
                                            <select name="category_id" class="form-control select2">
                                                <?php
                                                $q = $pdo->prepare("SELECT * FROM tbl_category WHERE category_status=? ORDER BY category_order ASC");
                                                $q->execute(['Active']);
                                                $res = $q->fetchAll();
                                                foreach ($res as $row) {
                                                    ?><option value="<?php echo safe_data($row['category_id']); ?>" <?php if($row['category_id'] == $category_id) {echo 'selected';} ?>><?php echo safe_data($row['category_name']); ?></option><?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Order</b></label>
                                        <input type="text" class="form-control" name="news_order" value="<?php echo safe_data($news_order); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Status</b></label>
                                        <div class="d-block">
                                            <select name="news_status" class="form-control select2">
                                                <option value="Active" <?php if($news_status == 'Active') {echo 'selected';} ?>>Active</option>
                                                <option value="Inactive" <?php if($news_status == 'Inactive') {echo 'selected';} ?>>Inactive</option>
                                            </select>
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