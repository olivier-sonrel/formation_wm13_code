<?php require_once('header.php'); ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Products</h4>
                <a href="product-add.php" class="btn btn-primary btn-xs">Add Product</a>
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
                                <th>Featured Photo</th>
                                <th>Name</th>
                                <th>Old Price</th>
                                <th>Current Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_product ORDER BY product_order ASC");
                            $statement->execute();
                            $result = $statement->fetchAll();                           
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo safe_data($i); ?></td>
                                    <td><img src="../uploads/<?php echo safe_data($row['product_featured_photo']); ?>" class="w_150"></td>
                                    <td><?php echo safe_data($row['product_name']); ?></td>
                                    <td>
                                        <?php if($row['product_old_price']!=''): ?>
                                        $<?php echo safe_data($row['product_old_price']); ?>
                                        <?php else: ?>
                                        N/A
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        $<?php echo safe_data($row['product_current_price']); ?>
                                    </td>
                                    <td>
                                        <?php echo safe_data($row['product_stock']); ?>
                                    </td>
                                    <td class="<?php if($row['product_status'] == 'Active') {echo 'text-success';} else {echo 'text-danger';} ?> font-weight-bold"><?php echo safe_data($row['product_status']); ?></td>
                                    <td><?php echo safe_data($row['product_order']); ?></td>
                                    <td>
                                        <a href="product-edit.php?id=<?php echo safe_data($row['product_id']); ?>" class="btn btn-primary btn-xs btn-block">Edit</a>
                                        <a href="product-delete.php?id=<?php echo safe_data($row['product_id']); ?>" class="btn btn-danger btn-xs btn-block" onClick="return confirm('Are you sure?');">Delete</a>  
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