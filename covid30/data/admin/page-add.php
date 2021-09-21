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
    }

    $path = $_FILES['banner']['name'];
    $path_tmp = $_FILES['banner']['tmp_name'];

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

        $statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_page'");
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row) {
            $ai_id = $row[10];
        }

        if($page_slug == '') {
            $temp_string = strtolower($page_name);
            $page_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
        } else {
            $temp_string = strtolower($page_slug);
            $page_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
        }

        $final_name = 'page-banner-'.$ai_id.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );
    
        $statement = $pdo->prepare("INSERT INTO tbl_page (
                            page_name,
                            page_slug,
                            page_content,
                            page_layout,
                            banner,
                            status,
                            meta_title,
                            meta_description
                        ) VALUES (?,?,?,?,?,?,?,?)");
        $statement->execute(array(
                            $page_name,
                            $page_slug,
                            $page_content,
                            $page_layout,
                            $final_name,
                            $status,
                            $meta_title,
                            $meta_description
                        ));
            
        $success_message = 'Page is added successfully!';
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Add Page</h4>
                <a href="page.php" class="btn btn-primary btn-xs">View Pages</a>
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
                            <label for=""><b class="text-muted d-block">Page Name *</b></label>
                            <input type="text" class="form-control" name="page_name">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Page Slug</b></label>
                            <input type="text" class="form-control" name="page_slug">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Page Layout *</b></label>
                            <div class="d-block">
                                <select class="form-control select2" name="page_layout" onChange="showContent1(this)">
                                    <option value="Full Width Page Layout">Full Width Page Layout</option>
                                    <option value="FAQ Page Layout">FAQ Page Layout</option>
                                    <option value="Prevention Page Layout">Prevention Page Layout</option>
                                    <option value="Doctor Page Layout">Doctor Page Layout</option>
                                    <option value="Photo Gallery Page Layout">Photo Gallery Page Layout</option>
                                    <option value="Video Gallery Page Layout">Video Gallery Page Layout</option>
                                    <option value="News Page Layout">News Page Layout</option>
                                    <option value="Contact Us Page Layout">Contact Us Page Layout</option>
                                    <option value="Product Page Layout">Product Page Layout</option>
                                </select>
                            </div>
                        </div>

                        <div id="showPageContentTextarea">
                            <div class="form-group">
                                <label for=""><b class="text-muted d-block">Page Content</b></label>
                                <textarea class="form-control editor" name="page_content"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Banner *</b></label>
                            <div class="d-block">
                                <input type="file" name="banner"><br>
                                <span class="text-danger">(Only jpg, jpeg, gif and png are allowed)</span>
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

<script>
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