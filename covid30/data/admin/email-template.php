<?php require_once('header.php'); ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Email Templates</h4>
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
                                <th>Email Template Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_email_template ORDER BY et_id ASC");
                            $statement->execute();
                            $result = $statement->fetchAll();                           
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo safe_data($i); ?></td>
                                    <td><?php echo safe_data($row['et_name']); ?></td>
                                    <td>
                                        <a href="email-template-edit.php?id=<?php echo safe_data($row['et_id']); ?>" class="btn btn-primary btn-xs">Edit</a>
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