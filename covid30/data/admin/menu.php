<?php require_once('header.php'); ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Menus</h4>
                <a href="menu-add.php" class="btn btn-primary btn-xs">Add Menu</a>
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
                                <th>Serial</th>
                                <th>Menu Type</th>
                                <th>Menu Name</th>
                                <th>Menu URL</th>
                                <th>Menu Order</th>
                                <th>Menu Parent</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $q = $pdo->prepare("SELECT * 
                                                FROM tbl_menu 
                                                ORDER BY menu_parent,menu_order ASC");
                            $q->execute();
                            $res = $q->fetchAll();
                            foreach ($res as $row) {
                                $i++;

                                if($row['menu_type']=='Page'):
                                    $r = $pdo->prepare("SELECT * 
                                                FROM tbl_page 
                                                WHERE page_id=?");
                                    $r->execute([$row['page_id']]);
                                    $res1 = $r->fetchAll();                           
                                    foreach ($res1 as $row1) {
                                        $menu_name = $row1['page_name'];
                                    }
                                    $menu_url = '---';
                                else:
                                    $menu_name = $row['menu_name'];
                                    $menu_url = $row['menu_url'];
                                endif;

                                ?>
                                <tr>
                                    <td><?php echo safe_data($i); ?></td>
                                    <td><?php echo safe_data($row['menu_type']); ?></td>
                                    <td><?php echo safe_data($menu_name); ?></td>
                                    <td class="w_200 wb_bw"><?php echo safe_data($menu_url); ?></td>
                                    <td><?php echo safe_data($row['menu_order']); ?></td>
                                    <td>
                                        <?php
                                        if($row['menu_parent'] == 0):
                                            echo '---';
                                        else:

                                            $r = $pdo->prepare("SELECT * 
                                                                FROM tbl_menu 
                                                                WHERE menu_id=?");
                                            $r->execute([$row['menu_parent']]);
                                            $res1 = $r->fetchAll();                           
                                            foreach ($res1 as $row1) {

                                                if($row1['page_id'] == 0):
                                                    echo safe_data($row1['menu_name']);
                                                else:
                                                    $s = $pdo->prepare("SELECT * 
                                                                        FROM tbl_page 
                                                                        WHERE page_id=?");
                                                    $s->execute([$row1['page_id']]);
                                                    $res2 = $s->fetchAll();                           
                                                    foreach ($res2 as $row2) {
                                                        echo safe_data($row2['page_name']);
                                                    }
                                                endif;
                                            }
                                        endif;
                                        ?>
                                    </td>
                                    <td>
                                        <a href="menu-edit.php?id=<?php echo safe_data($row['menu_id']); ?>" class="btn btn-primary btn-xs btn-block">Edit</a>
                                        <a href="menu-delete.php?id=<?php echo safe_data($row['menu_id']); ?>" class="btn btn-danger btn-xs btn-block" onClick="return confirm('Are you sure?');">Delete</a>  
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