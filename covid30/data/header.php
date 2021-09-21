<?php
ob_start();
session_start();
include("admin/inc/config.php");
include("admin/inc/functions.php");
$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';
$error_message2 = '';
$success_message2 = '';

// Getting the basic data for the website from database
$q = $pdo->prepare("SELECT * FROM tbl_setting_logo WHERE id=1");
$q->execute();
$result = $q->fetchAll();
foreach ($result as $row) {
	$logo = $row['logo'];
}

$q = $pdo->prepare("SELECT * FROM tbl_setting_favicon WHERE id=1");
$q->execute();
$result = $q->fetchAll();
foreach ($result as $row) {
	$favicon = $row['favicon'];
}

$q = $pdo->prepare("SELECT * FROM tbl_setting_top_bar WHERE id=1");
$q->execute();
$result = $q->fetchAll();
foreach ($result as $row) {
	$top_bar_email = $row['top_bar_email'];
	$top_bar_phone = $row['top_bar_phone'];
}


// Delete all subscribers who did not confirm email within 24 hours
$statement = $pdo->prepare("SELECT * FROM tbl_subscriber WHERE subs_active=0");
$statement->execute();
$result = $statement->fetchAll();							
foreach($result as $row)
{
	$subs_date_time = $row['subs_date_time'];
	$current_date_time = date('Y-m-d H:i:s');
	$t1 = strtotime($subs_date_time);
	$t2 = strtotime($current_date_time);
	$diff = $t2 - $t1;
	$res = floor($diff/(60));
	if($res > 1440)
	{
		$statement1 = $pdo->prepare("DELETE FROM tbl_subscriber WHERE subs_id=?");
		$statement1->execute(array($row['subs_id']));
	}
}
?>
<!DOCTYPE html>
<html lang="en">
   	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
        <!-- PHP loop to determine the page Title -->
		<?php 
            $cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
            if($cur_page == 'index.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_setting_home WHERE id=1");
                $statement->execute();
                $result = $statement->fetchAll();							
                foreach ($result as $row) 
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }

            if($cur_page == 'page.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_slug=?");
                $statement->execute(array($_REQUEST['slug']));
                $result = $statement->fetchAll();							
                foreach ($result as $row) 
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }

            if($cur_page == 'doctor.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_doctor WHERE slug=?");
                $statement->execute(array($_REQUEST['slug']));
                $result = $statement->fetchAll();
                foreach ($result as $row) 
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }

            if($cur_page == 'product.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE product_slug=?");
                $statement->execute(array($_REQUEST['slug']));
                $result = $statement->fetchAll();
                foreach ($result as $row) 
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }

            if($cur_page == 'prevention.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_prevention WHERE slug=?");
                $statement->execute(array($_REQUEST['slug']));
                $result = $statement->fetchAll();
                foreach ($result as $row) 
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }

            if($cur_page == 'news.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_news WHERE news_slug=?");
                $statement->execute(array($_REQUEST['slug']));
                $result = $statement->fetchAll();
                foreach ($result as $row) 
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }

            if($cur_page == 'category.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_category WHERE category_slug=?");
                $statement->execute(array($_REQUEST['slug']));
                $result = $statement->fetchAll();							
                foreach ($result as $row)
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }

            if($cur_page == 'search.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_setting_pages WHERE id=?");
                $statement->execute(array(1));
                $result = $statement->fetchAll();							
                foreach ($result as $row)
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }

            if($cur_page == 'cart.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_setting_pages WHERE id=?");
                $statement->execute(array(2));
                $result = $statement->fetchAll();							
                foreach ($result as $row)
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }

            if($cur_page == 'checkout.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_setting_pages WHERE id=?");
                $statement->execute(array(3));
                $result = $statement->fetchAll();							
                foreach ($result as $row)
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }

            if($cur_page == 'login.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_setting_pages WHERE id=?");
                $statement->execute(array(4));
                $result = $statement->fetchAll();							
                foreach ($result as $row)
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }

            if($cur_page == 'registration.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_setting_pages WHERE id=?");
                $statement->execute(array(5));
                $result = $statement->fetchAll();							
                foreach ($result as $row)
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }

            if($cur_page == 'forget-password.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_setting_pages WHERE id=?");
                $statement->execute(array(6));
                $result = $statement->fetchAll();							
                foreach ($result as $row)
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }

            if($cur_page == 'customer-dashboard.php'||$cur_page == 'customer-delivery-track.php'||$cur_page == 'customer-edit-password.php'||$cur_page == 'customer-edit-profile.php'||$cur_page == 'customer-invoice.php'||$cur_page == 'customer-order.php')
            {
                $statement = $pdo->prepare("SELECT * FROM tbl_setting_pages WHERE id=?");
                $statement->execute(array(7));
                $result = $statement->fetchAll();							
                foreach ($result as $row)
                {
                    echo '<meta name="description" content="'.$row['meta_description'].'">';
                    echo '<title>'.$row['meta_title'].'</title>';
                }
            }
		?>

		<!-- All CSS -->
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/animate.min.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/magnific-popup.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/owl.carousel.min.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/font-awesome.min.css">    	
    	<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/jquery.dataTables.min.css">	
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/select2.min.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/select2-bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/sweetalert2.min.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/meanmenu.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/spacing.css">

		<!-- Favicon -->
		<link href="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($favicon); ?>" rel="shortcut icon" type="image/png">


		<!-- All JS -->
		<script src="<?php echo BASE_URL; ?>js/jquery.min.js"></script>
		<script src="https://js.stripe.com/v2/"></script>
		<script src="<?php echo BASE_URL; ?>js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo BASE_URL; ?>js/jquery.magnific-popup.min.js"></script>
		<script src="<?php echo BASE_URL; ?>js/owl.carousel.min.js"></script>
		<script src="<?php echo BASE_URL; ?>js/wow.min.js"></script>
		<script src="<?php echo BASE_URL; ?>js/jquery.filterizr.min.js"></script>
		<script src="<?php echo BASE_URL; ?>js/jquery.meanmenu.js"></script>
		<script src="<?php echo BASE_URL; ?>js/waypoints.min.js"></script>
		<script src="<?php echo BASE_URL; ?>js/jquery.counterup.min.js"></script>		
		<script src="<?php echo BASE_URL; ?>js/jquery.dataTables.min.js"></script>
		<script src="<?php echo BASE_URL; ?>js/select2.full.js"></script>
		<script src="<?php echo BASE_URL; ?>js/sweetalert2.min.js"></script>


   	</head>
   	<body>

   		<div id="mySidepanel" class="sidepanel">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<a href="#">About</a>
			<a href="#">Services</a>
			<a href="#">Clients</a>
			<a href="#">Contact</a>
		</div>

   		<div class="top">
   			<div class="container">
   				<div class="row">
   					<div class="col-md-6">
   						<div class="top-contact">
							<ul>
								<li>
									<i class="fa fa-envelope-o" aria-hidden="true"></i>
									<span><?php echo safe_data($top_bar_email); ?></span>
								</li>
								<li>
									<i class="fa fa-phone" aria-hidden="true"></i>
									<span><?php echo safe_data($top_bar_phone); ?></span>
								</li>
							</ul>
						</div>
	   				</div>
   					<div class="col-md-6">
   						<div class="top-right">
	   						<div class="top-social">
								<ul>
									<?php //check tbl_social and create link and icon for each social items
									$q = $pdo->prepare("SELECT * FROM tbl_social WHERE social_status=? ORDER BY social_order ASC");
									$q->execute([1]);
									$res = $q->fetchAll();
									foreach ($res as $row) {
										?>
										<li><a href="<?php echo safe_data($row['social_url']); ?>" target="_blank"><i class="<?php echo safe_data($row['social_icon']); ?>"></i></a></li>
										<?php
									}
									?>
								</ul>
							</div>
                            <!-- control if customer connected, if yes button "customer" else button "register" "login" -->
							<div class="top-profile">
								<ul>
									<?php
									if(isset($_SESSION['customer'])) 
									{
										echo '<li><a href="'.BASE_URL.'customer-dashboard">Dashboard</a></li>';	
									}
									else
									{
										echo '
										<li><a href="'.BASE_URL.'login">Login</a></li>
										<li><a href="'.BASE_URL.'registration">Registration</a></li>
										';	
									}
									?>									
									<li class="cart">
										<a href="<?php echo BASE_URL ?>cart">Cart</a>
										<?php 
										if(isset($_SESSION['cart_product_id'])) {
											echo '<div class="number">'.count($_SESSION['cart_product_id']).'</div>';
										}
										?>
									</li>
								</ul>
							</div>
						</div>
   					</div>
   				</div>
   			</div>
   		</div>

      	<!-- Start Navbar Area -->
		<div class="navbar-area" id="stickymenu">

			<!-- Menu For Mobile Device -->
			<div class="mobile-nav">
				<a href="<?php echo BASE_URL; ?>" class="logo">
					<img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($logo); ?>" alt="">
				</a>
			</div>

			<!-- Menu For Desktop Device -->
			<div class="main-nav">
				<div class="container">
					<nav class="navbar navbar-expand-md navbar-light">
						<a class="navbar-brand" href="<?php echo BASE_URL; ?>">
							<img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($logo); ?>" alt="logo">
						</a>
						<div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto">
								<!-- check tbl_menu and prepare the menu nav bar -->
								<?php
                                $q = $pdo->prepare("SELECT * FROM tbl_menu WHERE menu_parent=? ORDER BY menu_order ASC");
                                $q->execute(array(0));
                                $res = $q->fetchAll();
                                foreach ($res as $row) {
                                    
                                    $r = $pdo->prepare("SELECT * FROM tbl_menu WHERE menu_parent=?");
                                    $r->execute(array($row['menu_id']));
                                    $total = $r->rowCount();

                                    echo '<li class="nav-item">';
                                    
                                    if($row['page_id'] == 0) {
                                        
                                        if($row['menu_url'] == '') {
                                            $final_url = 'javascript:void(0);';
                                        } else {
                                            $final_url = $row['menu_url'];
                                        }                                       
                                        ?>
                                        <a href="<?php echo safe_data($final_url); ?>" class="nav-link <?php if($total) {echo 'dropdown-toggle';} ?>"><?php echo safe_data($row['menu_name']); ?></a>
                                        <?php
                                    } else {
                                        $r = $pdo->prepare("SELECT * FROM tbl_page WHERE page_id=? ");
                                        $r->execute(array($row['page_id']));
                                        $res1 = $r->fetchAll();
                                        foreach ($res1 as $row1) {
                                            ?>
                                            <a href="<?php echo BASE_URL.'page/'.$row1['page_slug']; ?>" class="nav-link <?php if($total) {echo 'dropdown-toggle';} ?>"><?php echo safe_data($row1['page_name']); ?></a>
                                            <?php
                                        }
                                    }

                                    // Checking for sub-menu
                                    $r = $pdo->prepare("SELECT * FROM tbl_menu WHERE menu_parent=? ORDER BY menu_order ASC");
                                    $r->execute(array($row['menu_id']));
                                    $total = $r->rowCount();
                                    if($total) {
                                        echo '<ul class="dropdown-menu">';

                                        $res1 = $r->fetchAll();
                                        foreach ($res1 as $row1) {
                                            
                                            echo '<li class="nav-item">';
                                            if($row1['page_id'] == 0) {
                                                if($row1['menu_url'] == '') {
                                                    $final_url1 = 'javascript:void(0);';
                                                } else {
                                                    $final_url1 = $row1['menu_url'];
                                                }
                                                ?>
                                                <a href="<?php echo safe_data($final_url1); ?>" class="nav-link"><?php echo safe_data($row1['menu_name']); ?></a>
                                                <?php
                                            } else {
                                                $s = $pdo->prepare("SELECT * FROM tbl_page WHERE page_id=?");
                                                $s->execute(array($row1['page_id']));
                                                $res2 = $s->fetchAll();
                                                foreach ($res2 as $row2) {
                                                    ?>
                                                    <a href="<?php echo BASE_URL.'page/'.$row2['page_slug']; ?>" class="nav-link"><?php echo safe_data($row2['page_name']); ?></a>
                                                    <?php
                                                }
                                            }
                                            echo '</li>';
                                        }

                                        echo '</ul>';
                                    }


                                    echo '</li>';

                                }
                                ?>

							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
		<!-- End Navbar Area -->