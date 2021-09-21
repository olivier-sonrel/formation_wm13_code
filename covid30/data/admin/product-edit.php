<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $product_name          = sanitize_string($_POST['product_name']);
    $product_slug          = sanitize_string($_POST['product_slug']);
    $product_old_price     = sanitize_float($_POST['product_old_price']);
    $product_current_price = sanitize_float($_POST['product_current_price']);
    $product_stock         = sanitize_int($_POST['product_stock']);
    $product_content       = sanitize_ckeditor($_POST['product_content']);
    $product_content_short = sanitize_string($_POST['product_content_short']);
    $product_return_policy = sanitize_ckeditor($_POST['product_return_policy']);
    $product_order         = sanitize_int($_POST['product_order']);
    $product_status        = sanitize_string($_POST['product_status']);
    $meta_title            = sanitize_string($_POST['meta_title']);
    $meta_description      = sanitize_string($_POST['meta_description']);

    $valid = 1;

    if($product_name == '')
    {
        $valid = 0;
        $error_message .= 'Name can not be empty<br>';
    }

    if($product_current_price == '')
    {
        $valid = 0;
        $error_message .= 'Current Price can not be empty<br>';
    }

    if($product_stock == '')
    {
        $valid = 0;
        $error_message .= 'Stock can not be empty<br>';
    }

    if($product_content == '')
    {
        $valid = 0;
        $error_message .= 'Content can not be empty<br>';
    }

    if($product_content_short == '')
    {
        $valid = 0;
        $error_message .= 'Short Content can not be empty<br>';
    }

    if($valid == 1) 
    {
        $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id=?");
        $statement->execute(array($_REQUEST['id']));
        $result = $statement->fetchAll();
        foreach($result as $row) {
            $current_name = $row['product_name'];
        }

        if($product_slug == '') {
            // generate slug
            $temp_string = strtolower($product_name);
            $product_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);;
        } else {
            $temp_string = strtolower($product_slug);
            $product_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
        }

        // if slug already exists, then rename it
        $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE product_slug=? AND product_name!=?");
        $statement->execute(array($product_slug,$current_name));
        $total = $statement->rowCount();
        if($total) {
            $product_slug = $product_slug.'-1';
        }

        $statement = $pdo->prepare("UPDATE tbl_product SET  
                    product_name=?, 
                    product_slug=?, 
                    product_old_price=?, 
                    product_current_price=?, 
                    product_stock=?,
                    product_content=?, 
                    product_content_short=?, 
                    product_return_policy=?,
                    product_order=?, 
                    product_status=?,
                    meta_title=?,
                    meta_description=? 
                    WHERE product_id=?
                ");
        $statement->execute(array(
                    $product_name,
                    $product_slug,
                    $product_old_price,
                    $product_current_price,
                    $product_stock,
                    $product_content,
                    $product_content_short,
                    $product_return_policy,
                    $product_order,
                    $product_status,
                    $meta_title,
                    $meta_description,
                    $_REQUEST['id']
                ));
        
        $success_message = 'Product information is updated successfully!';
    }    
}


if(isset($_POST['form2']))
{
    $valid = 1;

    $path = $_FILES['product_featured_photo']['name'];
    $path_tmp = $_FILES['product_featured_photo']['tmp_name'];

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
        if($mime == 'image/jpeg') { $ext = 'jpg'; }
        elseif($mime == 'image/png') { $ext = 'png'; }
        elseif($mime == 'image/gif') { $ext = 'gif'; }

        unlink('../uploads/'.$current_photo);

        $final_name = 'product-'.$_REQUEST['id'].'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );

        $statement = $pdo->prepare("UPDATE tbl_product SET  
                    product_featured_photo=? 
                    WHERE product_id=?
                ");
        $statement->execute(array(
                    $final_name,
                    $_REQUEST['id']
                ));

        $success_message = 'Product Featured photo is updated successfully!';
    }    
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id=?");
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
                <h4 class="page-title pull-left">Edit Product</h4>
                <a href="product.php" class="btn btn-primary btn-xs">View Products</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll();
foreach ($result as $row) {
	$product_name           = $row['product_name'];
	$product_slug           = $row['product_slug'];
	$product_old_price      = $row['product_old_price'];
	$product_current_price  = $row['product_current_price'];
    $product_stock          = $row['product_stock'];
	$product_content        = $row['product_content'];
	$product_content_short  = $row['product_content_short'];
    $product_return_policy  = $row['product_return_policy'];
	$product_featured_photo = $row['product_featured_photo'];
	$product_order          = $row['product_order'];
	$product_status         = $row['product_status'];
	$meta_title             = $row['meta_title'];
	$meta_description       = $row['meta_description'];
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
			                            <input type="text" class="form-control" name="product_name" value="<?php echo $product_name; ?>">
			                        </div>
			                        <div class="form-group">
			                            <label for=""><b class="text-muted d-block">Slug</b></label>
			                            <input type="text" class="form-control" name="product_slug" value="<?php echo $product_slug; ?>">
			                        </div>
			                        <div class="form-group">
			                            <label for=""><b class="text-muted d-block">Old Price</b></label>
			                            <input type="text" class="form-control" name="product_old_price" value="<?php echo $product_old_price; ?>">
			                        </div>
			                        <div class="form-group">
			                            <label for=""><b class="text-muted d-block">Current Price *</b></label>
			                            <input type="text" class="form-control" name="product_current_price" value="<?php echo $product_current_price; ?>">
			                        </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Stock *</b></label>
                                        <input type="text" class="form-control" name="product_stock" value="<?php echo $product_stock; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Content *</b></label>
                                        <textarea class="form-control editor" name="product_content"><?php echo safe_data($product_content); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Short Content *</b></label>
                                        <textarea class="form-control h_100" name="product_content_short"><?php echo safe_data($product_content_short); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Return Policy</b></label>
                                        <textarea class="form-control editor" name="product_return_policy"><?php echo safe_data($product_return_policy); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Order</b></label>
                                        <input type="text" class="form-control" name="product_order" value="<?php echo safe_data($product_order); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Status</b></label>
                                        <div class="d-block">
                                            <select name="product_status" class="form-control select2">
                                                <option value="Active" <?php if($product_status == 'Active') {echo 'selected';} ?>>Active</option>
                                                <option value="Inactive" <?php if($product_status == 'Inactive') {echo 'selected';} ?>>Inactive</option>
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
                                    <input type="hidden" name="current_photo" value="<?php echo safe_data($product_featured_photo); ?>">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Existing Photo</b></label>
                                        <div class="d-block">
                                            <img src="../uploads/<?php echo safe_data($product_featured_photo); ?>" class="w_400">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Change Photo</b></label>
                                        <div class="d-block">
                                            <input type="file" name="product_featured_photo"><br>
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