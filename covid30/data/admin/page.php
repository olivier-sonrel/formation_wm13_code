<?php require_once('header.php'); ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Pages</h4>
                <a href="page-add.php" class="btn btn-primary btn-xs">Add Page</a>
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
                                <th>Page Name</th>
                                <th>Page Slug</th>
                                <th>Page Layout</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_page ORDER BY page_id ASC");
                            $statement->execute();
                            $result = $statement->fetchAll();                           
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo safe_data($i); ?></td>
                                    <td><?php echo safe_data($row['page_name']); ?></td>
                                    <td><?php echo safe_data($row['page_slug']); ?></td>
                                    <td><?php echo safe_data($row['page_layout']); ?></td>
                                    <td><?php echo safe_data($row['status']); ?></td>
                                    <td>
                                        <a href="page-edit.php?id=<?php echo safe_data($row['page_id']); ?>" class="btn btn-primary btn-xs">Edit</a>
                                        <a href="page-delete.php?id=<?php echo safe_data($row['page_id']); ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>  
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