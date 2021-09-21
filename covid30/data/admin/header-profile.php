<div class="col-sm-6 clearfix">
    <div class="user-profile pull-right">
        <img class="avatar user-thumb" src="../uploads/<?php echo safe_data($_SESSION['user']['photo']); ?>" alt="avatar">
        <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Logged in as: <?php echo safe_data($_SESSION['user']['full_name']); ?> <i class="fa fa-angle-down"></i></h4>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="profile-edit.php">Edit Profile</a>
            <a class="dropdown-item" href="logout.php">Log Out</a>
        </div>
    </div>
</div>