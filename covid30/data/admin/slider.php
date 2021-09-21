<?php require_once('header.php'); ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Sliders</h4>
                <a href="slider-add.php" class="btn btn-primary btn-xs">Add Slider</a>
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
                    <table id="d_table" class="text-left table w_100_p">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>SL</th>
                                <th>Photo</th>
                                <th>Heading</th>
                                <th>Button Text</th>
                                <th>Button URL</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_slider ORDER BY slide_order ASC");
                            $statement->execute();
                            $result = $statement->fetchAll();                           
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo safe_data($i); ?></td>
                                    <td><img src="../uploads/<?php echo safe_data($row['photo']); ?>" alt="<?php echo safe_data($row['heading']); ?>" class="w_200"></td>
                                    <td><?php echo safe_data($row['heading']); ?></td>
                                    <td><?php echo safe_data($row['button_text']); ?></td>
                                    <td><?php echo safe_data($row['button_url']); ?></td>
                                    <td class="<?php if($row['status'] == 'Active') {echo 'text-success';} else {echo 'text-danger';} ?> font-weight-bold"><?php echo safe_data($row['status']); ?></td>
                                    <td><?php echo safe_data($row['slide_order']); ?></td>
                                    <td>
                                        <a href="slider-edit.php?id=<?php echo safe_data($row['id']); ?>" class="btn btn-primary btn-xs btn-block">Edit</a>
                                        <a href="slider-delete.php?id=<?php echo safe_data($row['id']); ?>" class="btn btn-danger btn-xs btn-block" onClick="return confirm('Are you sure?');">Delete</a>  
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

    </div>
</div>

<?php require_once('footer.php'); ?>