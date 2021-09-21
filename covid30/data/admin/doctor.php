<?php require_once('header.php'); ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Doctors</h4>
                <a href="doctor-add.php" class="btn btn-primary btn-xs">Add Doctor</a>
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
                                <th>Designation</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $statement = $pdo->prepare("SELECT * FROM tbl_doctor ORDER BY doctor_order ASC");
                            $statement->execute();
                            $result = $statement->fetchAll();                           
                            foreach ($result as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo safe_data($i); ?></td>
                                    <td><img src="../uploads/<?php echo safe_data($row['photo']); ?>" class="w_100"></td>
                                    <td><?php echo safe_data($row['name']); ?></td>
                                    <td><?php echo safe_data($row['designation']); ?></td>
                                    <td class="<?php if($row['status'] == 'Active') {echo 'text-success';} else {echo 'text-danger';} ?> font-weight-bold"><?php echo safe_data($row['status']); ?></td>
                                    <td><?php echo safe_data($row['doctor_order']); ?></td>
                                    <td>
                                        <a href="doctor-detail.php?id=<?php echo safe_data($row['id']); ?>" class="btn btn-warning btn-xs" data-toggle="modal" data-target=".doc_modal<?php echo safe_data($i); ?>">Details</a>
                                        <a href="doctor-edit.php?id=<?php echo safe_data($row['id']); ?>" class="btn btn-primary btn-xs">Edit</a>
                                        <a href="doctor-delete.php?id=<?php echo safe_data($row['id']); ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>  
                                    </td>
                                </tr>
                                <div class="modal fade doc_modal<?php echo safe_data($i); ?> modal-arf">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Doctor Details</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="item">
                                                    <div class="item-value">
                                                        <img src="../uploads/<?php echo safe_data($row['photo']); ?>" class="w_200">
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="item-heading">Name:</div>
                                                    <div class="item-value"><?php echo safe_data($row['name']); ?></div>
                                                </div>
                                                <div class="item">
                                                    <div class="item-heading">Designation:</div>
                                                    <div class="item-value"><?php echo safe_data($row['designation']); ?></div>
                                                </div>

                                                <?php if($row['degree']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Degree:</div>
                                                    <div class="item-value"><?php echo safe_data($row['degree']); ?></div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if($row['detail']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Detail:</div>
                                                    <div class="item-value"><?php echo safe_data($row['detail']); ?></div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if($row['practice_location']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Practice Location:</div>
                                                    <div class="item-value"><?php echo safe_data($row['practice_location']); ?></div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if($row['advice']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Advice:</div>
                                                    <div class="item-value"><?php echo safe_data($row['advice']); ?></div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if($row['facebook']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Facebook:</div>
                                                    <div class="item-value"><?php echo safe_data($row['facebook']); ?></div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if($row['twitter']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Twitter:</div>
                                                    <div class="item-value"><?php echo safe_data($row['twitter']); ?></div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if($row['linkedin']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Linkedin:</div>
                                                    <div class="item-value"><?php echo safe_data($row['linkedin']); ?></div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if($row['youtube']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Youtube:</div>
                                                    <div class="item-value"><?php echo safe_data($row['youtube']); ?></div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if($row['instagram']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Instagram:</div>
                                                    <div class="item-value"><?php echo safe_data($row['instagram']); ?></div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if($row['email']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Email:</div>
                                                    <div class="item-value"><?php echo safe_data($row['email']); ?></div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if($row['phone']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Phone:</div>
                                                    <div class="item-value"><?php echo safe_data($row['phone']); ?></div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if($row['website']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Website:</div>
                                                    <div class="item-value"><?php echo safe_data($row['website']); ?></div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if($row['address']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Address:</div>
                                                    <div class="item-value"><?php echo safe_data($row['address']); ?></div>
                                                </div>
                                                <?php endif; ?>

                                                <?php if($row['video_youtube']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Video:</div>
                                                    <div class="item-value admin_iframe_view_1">
                                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo safe_data($row['video_youtube']); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                    </div>
                                                </div>
                                                <?php endif; ?>

                                                <div class="item">
                                                    <div class="item-heading">Order:</div>
                                                    <div class="item-value"><?php echo safe_data($row['doctor_order']); ?></div>
                                                </div>
                                                <div class="item">
                                                    <div class="item-heading">Status:</div>
                                                    <div class="item-value"><?php echo safe_data($row['status']); ?></div>
                                                </div>

                                                <?php if($row['meta_title']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Meta Title:</div>
                                                    <div class="item-value"><?php echo safe_data($row['meta_title']); ?></div>
                                                </div>
                                                <?php endif; ?>
                                                
                                                <?php if($row['meta_description']!=''): ?>
                                                <div class="item">
                                                    <div class="item-heading">Meta Description:</div>
                                                    <div class="item-value"><?php echo safe_data($row['meta_description']); ?></div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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