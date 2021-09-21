<?php require_once('header.php'); ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Comment (Approved)</h4>
                <a href="comment-pending.php" class="btn btn-primary btn-xs">Pending Comments</a>
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
                                <th>Person Name</th>
                                <th>Person Email</th>
                                <th class="w_200">Person Message</th>
                                <th>News Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * 
                                FROM tbl_comment t1
                                JOIN tbl_news t2
                                ON t1.news_id = t2.news_id
                                WHERE t1.comment_status=? ORDER BY t1.comment_id ASC");
                            $statement->execute(['Approved']);
                            $result = $statement->fetchAll();                           
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo safe_data($i); ?></td>
                                    <td><?php echo safe_data($row['person_name']); ?></td>
                                    <td><?php echo safe_data($row['person_email']); ?></td>
                                    <td><?php echo nl2br($row['person_message']); ?></td>
                                    <td>
                                        <?php echo safe_data($row['news_title']); ?>
                                        <div class="mt_10"><a href="<?php echo BASE_URL; ?>news/<?php echo safe_data($row['news_slug']); ?>" class="btn btn-xs btn-warning" target="_blank">See News</a></div>
                                    </td>
                                    <td>
                                        <a href="comment-make-pending.php?id=<?php echo safe_data($row['comment_id']); ?>" class="btn btn-primary btn-xs btn-block">Make Pending</a>
                                        <a href="comment-delete.php?id=<?php echo safe_data($row['comment_id']); ?>" class="btn btn-danger btn-xs btn-block" onClick="return confirm('Are you sure?');">Delete</a>  
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