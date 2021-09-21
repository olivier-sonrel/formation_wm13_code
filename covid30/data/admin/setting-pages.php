<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form_1'])) {
    $meta_title = sanitize_string($_POST['meta_title']);
    $meta_description = sanitize_string($_POST['meta_description']);
    $statement = $pdo->prepare("UPDATE tbl_setting_pages SET meta_title=?,meta_description=? WHERE id=?");
    $statement->execute([$meta_title,$meta_description,1]);
    $_SESSION['success_message'] = 'Search Page Setting is updated successfully.';
    header('location: setting-pages.php');
    exit;
}

if(isset($_POST['form_2'])) {
    $meta_title = sanitize_string($_POST['meta_title']);
    $meta_description = sanitize_string($_POST['meta_description']);
    $statement = $pdo->prepare("UPDATE tbl_setting_pages SET meta_title=?,meta_description=? WHERE id=?");
    $statement->execute([$meta_title,$meta_description,2]);
    $_SESSION['success_message'] = 'Cart Page Setting is updated successfully.';
    header('location: setting-pages.php');
    exit;
}

if(isset($_POST['form_3'])) {
    $meta_title = sanitize_string($_POST['meta_title']);
    $meta_description = sanitize_string($_POST['meta_description']);
    $statement = $pdo->prepare("UPDATE tbl_setting_pages SET meta_title=?,meta_description=? WHERE id=?");
    $statement->execute([$meta_title,$meta_description,3]);
    $_SESSION['success_message'] = 'Checkout Page Setting is updated successfully.';
    header('location: setting-pages.php');
    exit;
}

if(isset($_POST['form_4'])) {
    $meta_title = sanitize_string($_POST['meta_title']);
    $meta_description = sanitize_string($_POST['meta_description']);
    $statement = $pdo->prepare("UPDATE tbl_setting_pages SET meta_title=?,meta_description=? WHERE id=?");
    $statement->execute([$meta_title,$meta_description,4]);
    $_SESSION['success_message'] = 'Login Page Setting is updated successfully.';
    header('location: setting-pages.php');
    exit;
}

if(isset($_POST['form_5'])) {
    $meta_title = sanitize_string($_POST['meta_title']);
    $meta_description = sanitize_string($_POST['meta_description']);
    $statement = $pdo->prepare("UPDATE tbl_setting_pages SET meta_title=?,meta_description=? WHERE id=?");
    $statement->execute([$meta_title,$meta_description,5]);
    $_SESSION['success_message'] = 'Registration Page Setting is updated successfully.';
    header('location: setting-pages.php');
    exit;
}

if(isset($_POST['form_6'])) {
    $meta_title = sanitize_string($_POST['meta_title']);
    $meta_description = sanitize_string($_POST['meta_description']);
    $statement = $pdo->prepare("UPDATE tbl_setting_pages SET meta_title=?,meta_description=? WHERE id=?");
    $statement->execute([$meta_title,$meta_description,6]);
    $_SESSION['success_message'] = 'Forget Password Page Setting is updated successfully.';
    header('location: setting-pages.php');
    exit;
}

if(isset($_POST['form_7'])) {
    $meta_title = sanitize_string($_POST['meta_title']);
    $meta_description = sanitize_string($_POST['meta_description']);
    $statement = $pdo->prepare("UPDATE tbl_setting_pages SET meta_title=?,meta_description=? WHERE id=?");
    $statement->execute([$meta_title,$meta_description,7]);
    $_SESSION['success_message'] = 'Customer Panel Page Setting is updated successfully.';
    header('location: setting-pages.php');
    exit;
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Setting - Other Pages</h4>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$i=0;
$statement = $pdo->prepare("SELECT * FROM tbl_setting_pages ORDER BY id ASC");
$statement->execute();
$result = $statement->fetchAll();
foreach ($result as $row) {
    $i++;
    $meta_title[$i] = $row['meta_title'];
    $meta_description[$i] = $row['meta_description'];
}
?>


<div class="main-content-inner">
    <div class="row">

        
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">

                    <?php
                    if( (isset($error_message)) && ($error_message!='') ):
                        echo '<div class="alert-items"><div class="alert alert-danger" role="alert"><b>';
                        echo safe_data($error_message);
                        echo '</b></div></div>';
                    endif;

                    if(isset($_SESSION['success_message'])):
                        echo '<div class="alert-items"><div class="alert alert-success" role="alert"><b>';
                        echo safe_data($_SESSION['success_message']);
                        echo '</b></div></div>';
                        unset($_SESSION['success_message']);
                    endif;
                    ?>

                    <div class="d-md-flex arf-vertical-tab">

                        <div class="nav flex-column nav-pills mr-4 mb-3 mb-sm-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            
                            <a class="nav-link active" id="v-pills-tab-0" data-toggle="pill" href="#v-pills-t-0" role="tab" aria-controls="v-pills-t-0" aria-selected="true">
                                Search Page
                            </a>

                            <a class="nav-link" id="v-pills-tab-1" data-toggle="pill" href="#v-pills-t-1" role="tab" aria-controls="v-pills-t-1" aria-selected="false">
                                Cart Page
                            </a>

                            <a class="nav-link" id="v-pills-tab-2" data-toggle="pill" href="#v-pills-t-2" role="tab" aria-controls="v-pills-t-2" aria-selected="false">
                                Checkout Page
                            </a>

                            <a class="nav-link" id="v-pills-tab-3" data-toggle="pill" href="#v-pills-t-3" role="tab" aria-controls="v-pills-t-3" aria-selected="false">
                                Login Page
                            </a>

                            <a class="nav-link" id="v-pills-tab-4" data-toggle="pill" href="#v-pills-t-4" role="tab" aria-controls="v-pills-t-4" aria-selected="false">
                                Registration Page
                            </a>

                            <a class="nav-link" id="v-pills-tab-5" data-toggle="pill" href="#v-pills-t-5" role="tab" aria-controls="v-pills-t-5" aria-selected="false">
                                Forget Password
                            </a>

                            <a class="nav-link" id="v-pills-tab-6" data-toggle="pill" href="#v-pills-t-6" role="tab" aria-controls="v-pills-t-6" aria-selected="false">
                                Customer Panel
                            </a>

                        </div>

                        <div class="tab-content" id="v-pills-tabContent">

                            <div class="tab-pane fade show active" id="v-pills-t-0" role="tabpanel" aria-labelledby="v-pills-tab-0">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Meta Title</b></label>
                                        <input type="text" name="meta_title" class="form-control" value="<?php echo safe_data($meta_title[1]); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <textarea name="meta_description" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($meta_description[1]); ?></textarea>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_1">Update</button>
                                    </div>
                                </form>
                            </div>


                            <div class="tab-pane fade" id="v-pills-t-1" role="tabpanel" aria-labelledby="v-pills-tab-1">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Meta Title</b></label>
                                        <input type="text" name="meta_title" class="form-control" value="<?php echo safe_data($meta_title[2]); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <textarea name="meta_description" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($meta_description[2]); ?></textarea>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_2">Update</button>
                                    </div>
                                </form>
                            </div>



                            <div class="tab-pane fade" id="v-pills-t-2" role="tabpanel" aria-labelledby="v-pills-tab-2">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Meta Title</b></label>
                                        <input type="text" name="meta_title" class="form-control" value="<?php echo safe_data($meta_title[3]); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <textarea name="meta_description" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($meta_description[3]); ?></textarea>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_3">Update</button>
                                    </div>
                                </form>
                            </div>


                            <div class="tab-pane fade" id="v-pills-t-3" role="tabpanel" aria-labelledby="v-pills-tab-3">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Meta Title</b></label>
                                        <input type="text" name="meta_title" class="form-control" value="<?php echo safe_data($meta_title[4]); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <textarea name="meta_description" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($meta_description[4]); ?></textarea>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_4">Update</button>
                                    </div>
                                </form>
                            </div>



                            <div class="tab-pane fade" id="v-pills-t-4" role="tabpanel" aria-labelledby="v-pills-tab-4">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Meta Title</b></label>
                                        <input type="text" name="meta_title" class="form-control" value="<?php echo safe_data($meta_title[5]); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <textarea name="meta_description" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($meta_description[5]); ?></textarea>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_5">Update</button>
                                    </div>
                                </form>
                            </div>


                            <div class="tab-pane fade" id="v-pills-t-5" role="tabpanel" aria-labelledby="v-pills-tab-5">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Meta Title</b></label>
                                        <input type="text" name="meta_title" class="form-control" value="<?php echo safe_data($meta_title[6]); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <textarea name="meta_description" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($meta_description[6]); ?></textarea>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_6">Update</button>
                                    </div>
                                </form>
                            </div>


                            <div class="tab-pane fade" id="v-pills-t-6" role="tabpanel" aria-labelledby="v-pills-tab-6">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Meta Title</b></label>
                                        <input type="text" name="meta_title" class="form-control" value="<?php echo safe_data($meta_title[7]); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><b class="text-muted d-block">Subtitle</b></label>
                                        <textarea name="meta_description" class="form-control h_100" cols="30" rows="10"><?php echo safe_data($meta_description[7]); ?></textarea>
                                    </div>
                                    <div class="d-block mt-2">
                                        <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_7">Update</button>
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