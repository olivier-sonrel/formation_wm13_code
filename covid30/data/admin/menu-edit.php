<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form_page'])) {

    $valid = 1;

    $page_id = sanitize_int($_POST['page_id']);
    $menu_order = sanitize_int($_POST['menu_order']);
    $menu_parent = sanitize_int($_POST['menu_parent']);

    if(empty($menu_order)) {
        $valid = 0;
        $error_message .= "Menu Order can not be empty<br>";
    } else {
        if(!is_numeric($menu_order)) {
            $valid = 0;
            $error_message .= "Menu Order must be numeric value<br>";
        }
    }
    
    if($valid == 1) {
        $q = $pdo->prepare("UPDATE tbl_menu SET 
                    menu_type=?, 
                    page_id=?, 
                    menu_name=?,
                    menu_url=?,
                    menu_order=?,
                    menu_parent=?
        
                    WHERE menu_id=?
                ");
        $q->execute([
                    'Page',
                    $page_id,
                    '',
                    '',
                    $menu_order,
                    $menu_parent,
                    $_REQUEST['id']
                ]);
        $success_message = 'Menu is updated successfully.';
    }
}
?>

<?php
if(isset($_POST['form_other'])) {

    $valid = 1;

    $menu_name = sanitize_string($_POST['menu_name']);
    $menu_url = sanitize_url($_POST['menu_url']);
    $menu_order = sanitize_int($_POST['menu_order']);
    $menu_parent = sanitize_int($_POST['menu_parent']);

    if(empty($menu_order)) {
        $valid = 0;
        $error_message .= "Menu Order can not be empty<br>";
    } else {
        if(!is_numeric($menu_order)) {
            $valid = 0;
            $error_message .= "Menu Order must be numeric value<br>";
        }
    }

    if($valid == 1) {
        $q = $pdo->prepare("UPDATE tbl_menu SET 
                    menu_type=?,
                    menu_name=?,
                    menu_url=?,
                    menu_order=?,
                    menu_parent=?
        
                    WHERE menu_id=?
                ");
        $q->execute([
                    'Other',
                    $menu_name,
                    $menu_url,
                    $menu_order,
                    $menu_parent,
                    $_REQUEST['id']
                ]);
        $success_message = 'Menu is updated successfully.';
    }
}
?>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_menu WHERE menu_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll();
foreach ($result as $row) {
    $menu_type = $row['menu_type'];
    $page_id = $row['page_id'];
    $menu_name = $row['menu_name'];
    $menu_url = $row['menu_url'];
    $menu_order = $row['menu_order'];
    $menu_parent = $row['menu_parent'];
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Edit Menu</h4>
                <a href="menu.php" class="btn btn-primary btn-xs">View Menus</a>
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

                    
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link <?php if($menu_type == 'Page') {echo 'active';} ?>" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="<?php if($menu_type == 'Page') {echo 'true';} else {echo 'false';} ?>">Page as Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($menu_type == 'Other') {echo 'active';} ?>" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="<?php if($menu_type == 'Other') {echo 'true';} else {echo 'false';} ?>">Other Menu</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3" id="myTabContent">
                        <div class="tab-pane fade <?php if($menu_type == 'Page') {echo 'show active';} ?>" id="home" role="tabpanel" aria-labelledby="home-tab">
                            
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Select Page *</b></label>
                                    <div class="d-block">
                                        <select class="form-control select2 w_100_p" name="page_id">
                                            <?php
                                            $statement = $pdo->prepare("SELECT * FROM tbl_page ORDER BY page_name ASC");
                                            $statement->execute();
                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $row) {
                                                if($row['page_id']==$page_id) {
                                                    $sel = 'selected';
                                                } else {
                                                    $sel = '';
                                                }
                                                echo '<option value="'.$row['page_id'].'" '.$sel.'>'.$row['page_name'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Select Parent *</b></label>
                                    <div class="d-block">
                                        <select class="form-control select2 w_100_p" name="menu_parent">
                                            <option value="0" <?php if($menu_parent == 0){echo 'selected';} ?>>No Parent</option>
                                            <?php
                                            $q = $pdo->prepare("SELECT * 
                                                                FROM tbl_menu 
                                                                ORDER BY menu_order ASC");
                                            $q->execute();
                                            $res = $q->fetchAll();
                                            foreach ($res as $row) {
                                                if($row['menu_id'] == $menu_parent) {
                                                    $sel1 = 'selected';
                                                } else {
                                                    $sel1 = '';
                                                }
                                                if($row['page_id']==0) {      
                                                    echo '<option value="'.$row['menu_id'].'" '.$sel1.'>'.$row['menu_name'].'</option>';
                                                } else {
                                                    $r = $pdo->prepare("SELECT * 
                                                                        FROM tbl_page 
                                                                        WHERE page_id=?");
                                                    $r->execute([$row['page_id']]);
                                                    $res1 = $r->fetchAll();
                                                    foreach ($res1 as $row1) {
                                                        echo '<option value="'.$row['menu_id'].'" '.$sel1.'>'.$row1['page_name'].'</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Order *</b></label>
                                    <input type="text" class="form-control" name="menu_order" value="<?php echo safe_data($menu_order); ?>">
                                </div>
                                <div class="d-block mt-2">
                                    <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_page">Update</button>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade <?php if($menu_type == 'Other') {echo 'show active';} ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Menu Name *</b></label>
                                    <input type="text" class="form-control" name="menu_name" value="<?php echo safe_data($menu_name); ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Menu URL *</b></label>
                                    <input type="text" class="form-control" name="menu_url" value="<?php echo safe_data($menu_url); ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Select Parent *</b></label>
                                    <div class="d-block">
                                        <select class="form-control select2" name="menu_parent">
                                            <option value="0" <?php if($menu_parent == 0){echo 'selected';} ?>>No Parent</option>
                                            <?php
                                            $q = $pdo->prepare("SELECT * 
                                                                FROM tbl_menu 
                                                                ORDER BY menu_order ASC");
                                            $q->execute();
                                            $res = $q->fetchAll();
                                            foreach ($res as $row) {
                                                if($row['menu_id'] == $menu_parent) {
                                                    $sel1 = 'selected';
                                                } else {
                                                    $sel1 = '';
                                                }
                                                if($row['page_id']==0) {      
                                                    echo '<option value="'.$row['menu_id'].'" '.$sel1.'>'.$row['menu_name'].'</option>';
                                                } else {
                                                    $r = $pdo->prepare("SELECT * 
                                                                        FROM tbl_page 
                                                                        WHERE page_id=?");
                                                    $r->execute([$row['page_id']]);
                                                    $res1 = $r->fetchAll();
                                                    foreach ($res1 as $row1) {
                                                        echo '<option value="'.$row['menu_id'].'" '.$sel1.'>'.$row1['page_name'].'</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for=""><b class="text-muted d-block">Order *</b></label>
                                    <input type="text" class="form-control" name="menu_order" value="<?php echo safe_data($menu_order); ?>">
                                </div>
                                <div class="d-block mt-2">
                                    <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form_other">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>
                            

                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>