<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1']))
{
    $arr1 = array();
    $arr2 = array();
    $arr3 = array();
    $arr4 = array();

    foreach($_POST['social_id_arr'] as $val)
    {
        $arr1[] = sanitize_int($val);
    }
    foreach($_POST['social_url_arr'] as $val)
    {
        $arr2[] = sanitize_url($val);
    }
    foreach($_POST['social_order_arr'] as $val)
    {
        $arr3[] = sanitize_int($val);
    }
    foreach($_POST['social_status_arr'] as $val)
    {
        $arr4[] = sanitize_int($val);
    }

    for($i=0;$i<count($arr1);$i++)
    {
        $statement = $pdo->prepare("UPDATE tbl_social SET 
                    social_url=?,
                    social_order=?,
                    social_status=?
                    WHERE social_id=?");
        $statement->execute([
                    $arr2[$i],
                    $arr3[$i],
                    $arr4[$i],
                    $arr1[$i]
                ]);
    }    

    $success_message = 'Social Setting is updated successfully.';
}
?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Social Media</h4>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

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

                    if( (isset($success_message)) && ($success_message!='') ):
                        echo '<div class="alert-items"><div class="alert alert-success" role="alert"><b>';
                        echo safe_data($success_message);
                        echo '</b></div></div>';
                    endif;
                    ?>

                    <form action="" method="post">
                        <div class="single-table">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="text-white bg-primary">
                                        <tr class="text-white">
                                            <td scope="col">Name</td>
                                            <td scope="col">Icon</td>
                                            <td scope="col">URL</td>
                                            <td scope="col">Order</td>
                                            <td scope="col">Show?</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=0;
                                        $q = $pdo->prepare("SELECT * 
                                                            FROM tbl_social 
                                                            ORDER BY social_order ASC");
                                        $q->execute();
                                        $res = $q->fetchAll();
                                        foreach ($res as $row) {
                                            ?>
                                            <input type="hidden" name="social_id_arr[<?php echo safe_data($i); ?>]" value="<?php echo safe_data($row['social_id']); ?>">
                                            <tr>
                                                <th class="align-middle"><?php echo safe_data($row['social_name']); ?></th>
                                                <td class="align-middle"><i class="<?php echo safe_data($row['social_icon']); ?>"></i></td>
                                                <td><input type="text" name="social_url_arr[<?php echo safe_data($i); ?>]" class="form-control" value="<?php echo safe_data($row['social_url']); ?>"></td>
                                                <td><input type="text" name="social_order_arr[<?php echo safe_data($i); ?>]" class="form-control w_100" value="<?php echo safe_data($row['social_order']); ?>"></td>
                                                <td class="align-middle">
                                                    <input type="hidden" class="custom-control-input" name="social_status_arr[<?php echo safe_data($i); ?>]" value="0">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck<?php echo safe_data($i); ?>" name="social_status_arr[<?php echo safe_data($i); ?>]" value="1"  <?php if($row['social_status'] == 1) {echo 'checked';} ?>>
                                                        <label class="custom-control-label" for="customCheck<?php echo safe_data($i); ?>"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-block mt-2">
                                <button type="submit" class="btn btn-primary mt-2 pr-4 pl-4" name="form1">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
    </div>
</div>

<?php require_once('footer.php'); ?>