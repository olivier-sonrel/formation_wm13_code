<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $name          = sanitize_string($_POST['name']);
    $description   = sanitize_string($_POST['description']);
    $symptom_order = sanitize_int($_POST['symptom_order']);
    $status        = sanitize_string($_POST['status']);

    $valid = 1;

    if($name == '')
    {
        $valid = 0;
        $error_message .= 'Name can not be empty<br>';
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

        $statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_symptom'");
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row) {
            $ai_id=$row[10];
        }

        $final_name = 'symptom-'.$ai_id.'.'.$ext;
        move_uploaded_file( $path_tmp, '../uploads/'.$final_name );
    
        $statement = $pdo->prepare("INSERT INTO tbl_symptom (
                            name,
                            description,
                            photo,
                            symptom_order,
                            status
                        ) VALUES (?,?,?,?,?)");
        $statement->execute(array(
                            $name,
                            $description,
                            $final_name,
                            $symptom_order,
                            $status
                        ));
            
        $success_message = 'Symptom is added successfully!';
    }
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Add Symptom</h4>
                <a href="symptom.php" class="btn btn-primary btn-xs">View Symptoms</a>
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
                            <label for=""><b class="text-muted d-block">Description *</b></label>
                            <textarea class="form-control h_100" name="description"></textarea>
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
                            <input type="text" class="form-control" name="symptom_order">
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