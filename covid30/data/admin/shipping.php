<?php require_once('header.php'); ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Shipping</h4>
                <a href="shipping-add.php" class="btn btn-primary btn-xs">Add New</a>
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
                                <th>Shipping Name</th>
                                <th>Shipping Text</th>
                                <th>Shipping Cost</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_shipping WHERE shipping_status=? ORDER BY shipping_order ASC");
                            $statement->execute(['Active']);
                            $result = $statement->fetchAll();                           
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo safe_data($i); ?></td>
                                    <td><?php echo safe_data($row['shipping_name']); ?></td>
                                    <td><?php echo safe_data($row['shipping_text']); ?></td>
                                    <td>$<?php echo safe_data($row['shipping_cost']); ?></td>
                                    <td><?php echo safe_data($row['shipping_order']); ?></td>
                                    <td class="<?php if($row['shipping_status'] == 'Active') {echo 'text-success';} else {echo 'text-danger';} ?> font-weight-bold"><?php echo safe_data($row['shipping_status']); ?></td>
                                    <td>
                                        <a href="shipping-edit.php?id=<?php echo safe_data($row['shipping_id']); ?>" class="btn btn-primary btn-xs">Edit</a>
                                        <a href="shipping-delete.php?id=<?php echo safe_data($row['shipping_id']); ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>  
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