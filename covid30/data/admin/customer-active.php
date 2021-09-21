<?php require_once('header.php'); ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Active Customers</h4>
                <a href="customer-pending.php" class="btn btn-primary btn-xs">Pending Customers</a>
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
                                <th>Name, Email, Phone</th>
                                <th>Address Details</th>
                                <th>Change Status</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * 
                                FROM tbl_customer t1 
                                JOIN tbl_country t2
                                ON t1.customer_country_id = t2.country_id
                                WHERE t1.customer_status=? 
                                ORDER BY t1.customer_id ASC");
                            $statement->execute(['Active']);
                            $result = $statement->fetchAll();
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo safe_data($i); ?></td>
                                    <td>
                                        <?php echo safe_data($row['customer_name']); ?><br>
                                        <?php echo safe_data($row['customer_email']); ?><br>
                                        <?php echo safe_data($row['customer_phone']); ?>
                                    </td>
                                    <td>
                                        Country: <?php echo safe_data($row['country_name']); ?><br>
                                        Address: <?php echo safe_data($row['customer_address']); ?><br>
                                        State: <?php echo safe_data($row['customer_state']); ?><br>
                                        City: <?php echo safe_data($row['customer_city']); ?><br>
                                        Zip: <?php echo safe_data($row['customer_zip']); ?>
                                    </td>
                                    <td>
                                        <a href="customer-change-status.php?id=<?php echo safe_data($row['customer_id']); ?>" class="btn btn-warning btn-xs btn-block" onClick="return confirm('Are you sure?');">Make Pending</a>
                                    </td>
                                    <td>
                                        <a href="customer-delete.php?id=<?php echo safe_data($row['customer_id']); ?>" class="btn btn-danger btn-xs btn-block" onClick="return confirm('Are you sure?');">Delete</a>  
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