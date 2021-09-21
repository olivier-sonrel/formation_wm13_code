<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $category_name    = sanitize_string($_POST['category_name']);
    $category_slug    = sanitize_string($_POST['category_slug']);
    $category_order   = sanitize_ckeditor($_POST['category_order']);
    $category_status  = sanitize_string($_POST['category_status']);
    $meta_title       = sanitize_string($_POST['meta_title']);
    $meta_description = sanitize_string($_POST['meta_description']);

    $valid = 1;

    if($category_name == '')
    {
        $valid = 0;
        $error_message .= 'Category Name can not be empty<br>';
    }

    if($valid == 1) 
    {
        $statement = $pdo->prepare("SELECT * FROM tbl_category WHERE category_id=?");
        $statement->execute(array($_REQUEST['id']));
        $result = $statement->fetchAll();
        foreach($result as $row) {
            $current_name = $row['category_name'];
        }

        if($category_slug == '') {
            // generate slug
            $temp_string = strtolower($category_name);
            $category_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);;
        } else {
            $temp_string = strtolower($category_slug);
            $category_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
        }

        // if slug already exists, then rename it
        $statement = $pdo->prepare("SELECT * FROM tbl_category WHERE category_slug=? AND category_name!=?");
        $statement->execute(array($category_slug,$current_name));
        $total = $statement->rowCount();
        if($total) {
            $category_slug = $category_slug.'-1';
        }

        $statement = $pdo->prepare("UPDATE tbl_category SET  
                    category_name=?,
                    category_slug=?,
                    category_order=?,
                    category_status=?,
                    meta_title=?,
                    meta_description=?
                    WHERE category_id=?
                ");
        $statement->execute(array(
                    $category_name,
                    $category_slug,
                    $category_order,
                    $category_status,
                    $meta_title,
                    $meta_description,
                    $_REQUEST['id']
                ));
        $success_message = 'Category is updated successfully!';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM tbl_category WHERE category_id=?");
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
                <h4 class="page-title pull-left">Edit Category</h4>
                <a href="category.php" class="btn btn-primary btn-xs">View All</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_category WHERE category_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll();
foreach ($result as $row) {
    $category_name    = $row['category_name'];
    $category_slug    = $row['category_slug'];
    $category_order   = $row['category_order'];
    $category_status  = $row['category_status'];
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

                    <form action="" method="post">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Category Name *</b></label>
                            <input type="text" class="form-control" name="category_name" value="<?php echo safe_data($category_name); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Category Slug *</b></label>
                            <input type="text" class="form-control" name="category_slug" value="<?php echo safe_data($category_slug); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Order</b></label>
                            <input type="text" class="form-control" name="category_order" value="<?php echo safe_data($category_order); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Status</b></label>
                            <div class="d-block">
                                <select name="category_status" class="form-control select2">
                                    <option value="Active" <?php if($category_status == 'Active') {echo 'selected';} ?>>Active</option>
                                    <option value="Inactive" <?php if($category_status == 'Inactive') {echo 'selected';} ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Meta Title *</b></label>
                            <input type="text" class="form-control" name="meta_title" value="<?php echo safe_data($meta_title); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Meta Description *</b></label>
                            <textarea name="meta_description" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($meta_description); ?></textarea>
                        </div>
                        <div class="d-block mt-2">
                            <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form1">Update</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>