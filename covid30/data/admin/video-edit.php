<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $video_youtube = sanitize_string($_POST['video_youtube']);
    $video_caption = sanitize_string($_POST['video_caption']);
    $video_order   = sanitize_int($_POST['video_order']);

    $valid = 1;

    if($video_youtube == '')
    {
        $valid = 0;
        $error_message .= 'YouTube Id can not be empty<br>';
    }

    if($video_caption == '')
    {
        $valid = 0;
        $error_message .= 'Caption can not be empty<br>';
    }

    if($valid == 1) 
    {

        $statement = $pdo->prepare("UPDATE tbl_video SET  
                    video_youtube=?, 
                    video_caption=?, 
                    video_order=?
                    WHERE video_id=?
                ");
        $statement->execute(array(
                    $video_youtube,
                    $video_caption,
                    $video_order,
                    $_REQUEST['id']
                ));
        
        $success_message = 'Video is updated successfully!';
    }    
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM tbl_video WHERE video_id=?");
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
                <h4 class="page-title pull-left">Edit Video</h4>
                <a href="video.php" class="btn btn-primary btn-xs">View Videos</a>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_video WHERE video_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll();
foreach ($result as $row) {
    $video_youtube = $row['video_youtube'];
    $video_caption = $row['video_caption'];
    $video_order   = $row['video_order'];
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
                            <label for=""><b class="text-muted d-block">Existing Video *</b></label>
                            <div class="d-block">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo safe_data($video_youtube); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Video (YouTube Id) *</b></label>
                            <input type="text" class="form-control" name="video_youtube" value="<?php echo safe_data($video_youtube); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Caption *</b></label>
                            <input type="text" class="form-control" name="video_caption" value="<?php echo safe_data($video_caption); ?>">
                        </div>
                        <div class="form-group">
                            <label for=""><b class="text-muted d-block">Order</b></label>
                            <input type="text" class="form-control" name="video_order" value="<?php echo safe_data($video_order); ?>">
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