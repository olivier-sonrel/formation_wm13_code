<?php require_once('header.php'); ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Symptoms</h4>
                <a href="symptom-add.php" class="btn btn-primary btn-xs">Add Symptom</a>
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
                                <th>Name</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_symptom ORDER BY symptom_order ASC");
                            $statement->execute();
                            $result = $statement->fetchAll();                           
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo safe_data($i); ?></td>
                                    <td><img src="../uploads/<?php echo safe_data($row['photo']); ?>" class="w_100"></td>
                                    <td><?php echo safe_data($row['name']); ?></td>    
                                    <td class="<?php if($row['status'] == 'Active') {echo 'text-success';} else {echo 'text-danger';} ?> font-weight-bold"><?php echo safe_data($row['status']); ?></td>
                                    <td><?php echo safe_data($row['symptom_order']); ?></td>
                                    <td>
                                        <a href="symptom-edit.php?id=<?php echo safe_data($row['id']); ?>" class="btn btn-primary btn-xs">Edit</a>
                                        <a href="symptom-delete.php?id=<?php echo safe_data($row['id']); ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>  
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