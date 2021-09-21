<?php require_once('header.php'); ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">News</h4>
                <a href="news-add.php" class="btn btn-primary btn-xs">Add News</a>
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
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * 
                                                FROM tbl_news t1
                                                JOIN tbl_category t2
                                                ON t1.category_id = t2.category_id 
                                                ORDER BY t1.news_order ASC");
                            $statement->execute();
                            $result = $statement->fetchAll();                           
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo safe_data($i); ?></td>
                                    <td><img src="../uploads/<?php echo safe_data($row['photo']); ?>" class="w_150"></td>
                                    <td><?php echo safe_data($row['news_title']); ?></td>
                                    <td><?php echo safe_data($row['category_name']); ?></td>
                                    <td class="<?php if($row['news_status'] == 'Active') {echo 'text-success';} else {echo 'text-danger';} ?> font-weight-bold"><?php echo safe_data($row['news_status']); ?></td>
                                    <td><?php echo safe_data($row['news_order']); ?></td>
                                    <td>
                                        <a href="news-edit.php?id=<?php echo safe_data($row['news_id']); ?>" class="btn btn-primary btn-xs btn-block">Edit</a>
                                        <a href="news-delete.php?id=<?php echo safe_data($row['news_id']); ?>" class="btn btn-danger btn-xs btn-block" onClick="return confirm('Are you sure?');">Delete</a>  
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