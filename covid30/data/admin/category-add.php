<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $category_name    = sanitize_string($_POST['category_name']);
    $category_slug    = sanitize_string($_POST['category_slug']);
    $category_order   = sanitize_int($_POST['category_order']);
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
        if($category_slug == '') {
            $temp_string = strtolower($category_name);
            $category_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
        } else {
            $temp_string = strtolower($category_slug);
            $category_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
        }

        $statement = $pdo->prepare("INSERT INTO tbl_category (
                            category_name,
                            category_slug,
                            category_order,
                            category_status,
                            meta_title,
                            meta_description
                        ) VALUES (?,?,?,?,?,?)");
        $statement->execute(array(
                            $category_name,
                            $category_slug,
                            $category_order,
                            $category_status,
                            $meta_title,
                            $meta_description
                        ));
            
        $success_message = 'Category is added successfully!';
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Add Category</h4>
                <a href="category.php" class="btn btn-primary btn-xs">View All</a>
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

                    <form action="" method="post">
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Category Name *</b></label>
                            <input type="text" class="form-control" name="category_name">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Category Slug *</b></label>
                            <input type="text" class="form-control" name="category_slug">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Order</b></label>
                            <input type="text" class="form-control" name="category_order">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Status</b></label>
                            <div class="d-block">
                                <select name="category_status" class="form-control select2">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Meta Title *</b></label>
                            <input type="text" class="form-control" name="meta_title">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Meta Description *</b></label>
                            <textarea name="meta_description" class="form-control h_100" cols="30" rows="10"></textarea>
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