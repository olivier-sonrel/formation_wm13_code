<?php require_once('header.php'); ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Coupons</h4>
                <a href="coupon-add.php" class="btn btn-primary btn-xs">Add New</a>
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
                                <th>Code</th>
                                <th>Type</th>
                                <th>Discount</th>
                                <th>Max Use</th>
                                <th>Existing Use</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_coupon WHERE coupon_status=?");
                            $statement->execute(['Active']);
                            $result = $statement->fetchAll();                           
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo safe_data($i); ?></td>
                                    <td><?php echo safe_data($row['coupon_code']); ?></td>
                                    <td><?php echo safe_data($row['coupon_type']); ?></td>
                                    <td>$<?php echo safe_data($row['coupon_discount']); ?></td>
                                    <td><?php echo safe_data($row['coupon_maximum_use']); ?></td>
                                    <td><?php echo safe_data($row['coupon_existing_use']); ?></td>
                                    <td class="<?php if($row['coupon_status'] == 'Active') {echo 'text-success';} else {echo 'text-danger';} ?> font-weight-bold"><?php echo safe_data($row['coupon_status']); ?></td>
                                    <td>
                                        <a href="coupon-edit.php?id=<?php echo safe_data($row['coupon_id']); ?>" class="btn btn-primary btn-xs">Edit</a>
                                        <a href="coupon-delete.php?id=<?php echo safe_data($row['coupon_id']); ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>  
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