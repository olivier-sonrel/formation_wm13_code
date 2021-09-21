<?php
ob_start();
session_start();
include("inc/config.php");
include("inc/functions.php");
$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';

// Check if the user is logged in or not
if(!isset($_SESSION['user'])) {
    header('location: login.php');
    exit;
}

$q = $pdo->prepare("SELECT * FROM tbl_setting_logo WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
    $logo_admin = $row['logo_admin'];
}

// Current Page Access Level check for all pages
$cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" type="image/png" href="assets/images/icon/favicon.png">
    
    <!-- Basic -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <link rel="stylesheet" href="assets/css/select2.min.css">

    <!-- Amchart -->
    <link rel="stylesheet" href="assets/css/export.css" media="all">
    
    <!-- Datatable -->
    <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">

    <!-- Datepicker for bootstrap 4 -->
    <link rel="stylesheet" href="assets/css/gijgo.min.css">

    <!-- Others -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/spacing.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- Modernizr -->
    <script src="assets/js/modernizr-2.8.3.min.js"></script>

</head>

<body>    

    <!-- Page container area start -->
    <div class="page-container">

        <!-- Sidebar menu area start -->
        <div class="sidebar-menu do-not-print">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.php"><img src="../uploads/<?php echo safe_data($logo_admin); ?>" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            
                            <li class="<?php if($cur_page == 'index.php') {echo 'active';} ?>">
                                <a href="index.php">
                                    <i class="ti-dashboard"></i><span>Dashboard</span>
                                </a>
                            </li>

                            <li class="<?php if( $cur_page == 'setting-logo.php' || $cur_page == 'setting-favicon.php' || $cur_page == 'setting-top-bar.php' || $cur_page == 'setting-email.php' || $cur_page == 'setting-sidebar.php' || $cur_page == 'setting-payment.php' || $cur_page == 'setting-order.php' || $cur_page == 'setting-footer.php' || $cur_page == 'footer-link.php'||$cur_page == 'footer-link-add.php'||$cur_page == 'footer-link-edit.php' || $cur_page == 'footer-page.php'||$cur_page == 'footer-page-add.php'||$cur_page == 'footer-page-edit.php' || $cur_page == 'setting-home.php' || $cur_page == 'setting-contact.php' || $cur_page == 'setting-pages.php' || $cur_page == 'setting-banner.php' ) {echo 'active';} ?>">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i><span>Website Settings</span></a>
                                <ul class="collapse">
                                    
                                    <li class="<?php if($cur_page == 'setting-logo.php') {echo 'active';} ?>">
                                        <a href="setting-logo.php">Logo</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'setting-favicon.php') {echo 'active';} ?>">
                                        <a href="setting-favicon.php">Favicon</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'setting-top-bar.php') {echo 'active';} ?>">
                                        <a href="setting-top-bar.php">Top Bar</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'setting-home.php') {echo 'active';} ?>">
                                        <a href="setting-home.php">Home Page</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'setting-contact.php') {echo 'active';} ?>">
                                        <a href="setting-contact.php">Contact Page</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'setting-pages.php') {echo 'active';} ?>">
                                        <a href="setting-pages.php">Other Pages</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'setting-banner.php') {echo 'active';} ?>">
                                        <a href="setting-banner.php">Banner</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'setting-email.php') {echo 'active';} ?>">
                                        <a href="setting-email.php">Email</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'setting-sidebar.php') {echo 'active';} ?>">
                                        <a href="setting-sidebar.php">Sidebar</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'setting-payment.php') {echo 'active';} ?>">
                                        <a href="setting-payment.php">Payment</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'setting-order.php') {echo 'active';} ?>">
                                        <a href="setting-order.php">Order</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'setting-footer.php') {echo 'active';} ?>">
                                        <a href="setting-footer.php">Footer (Contact)</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'footer-link.php'||$cur_page == 'footer-link-add.php'||$cur_page == 'footer-link-edit.php') {echo 'active';} ?>">
                                        <a href="footer-link.php">Footer (Links)</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'footer-page.php'||$cur_page == 'footer-page-add.php'||$cur_page == 'footer-page-edit.php') {echo 'active';} ?>">
                                        <a href="footer-page.php">Footer (Pages)</a>
                                    </li>

                                    

                                </ul>
                            </li>

                            <li class="<?php if($cur_page == 'page.php' || $cur_page == 'page-add.php' || $cur_page == 'page-edit.php') {echo 'active';} ?>">
                                <a href="page.php">
                                    <i class="ti-receipt"></i><span>Page</span>
                                </a>
                            </li>

                            <li class="<?php if($cur_page == 'menu.php' || $cur_page == 'menu-add.php' || $cur_page == 'menu-edit.php') {echo 'active';} ?>">
                                <a href="menu.php">
                                    <i class="ti-menu-alt"></i><span>Menu</span>
                                </a>
                            </li>

                            <li class="<?php if($cur_page == 'slider.php' || $cur_page == 'slider-add.php' || $cur_page == 'slider-edit.php') {echo 'active';} ?>">
                                <a href="slider.php">
                                    <i class="ti-layout-slider"></i><span>Slider</span>
                                </a>
                            </li>

                            <li class="<?php if( $cur_page == 'category.php' || $cur_page == 'category-add.php' || $cur_page == 'category-edit.php' || $cur_page == 'news.php' || $cur_page == 'news-add.php' || $cur_page == 'news-edit.php' || $cur_page == 'comment-approved.php' || $cur_page == 'comment-pending.php') {echo 'active';} ?>">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-control-shuffle"></i><span>News</span></a>
                                <ul class="collapse">
                                    
                                    <li class="<?php if($cur_page == 'category.php' || $cur_page == 'category-add.php' || $cur_page == 'category-edit.php') {echo 'active';} ?>">
                                        <a href="category.php">Category</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'news.php' || $cur_page == 'news-add.php' || $cur_page == 'news-edit.php') {echo 'active';} ?>">
                                        <a href="news.php">News</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'comment-approved.php') {echo 'active';} ?>">
                                        <a href="comment-approved.php">Approved Comments</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'comment-pending.php') {echo 'active';} ?>">
                                        <a href="comment-pending.php">Pending Comments</a>
                                    </li>

                                </ul>
                            </li>

                            <li class="<?php if( $cur_page == 'photo.php' || $cur_page == 'photo-add.php' || $cur_page == 'photo-edit.php' || $cur_page == 'video.php' || $cur_page == 'video-add.php' || $cur_page == 'video-edit.php') {echo 'active';} ?>">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-gallery"></i><span>Gallery</span></a>
                                <ul class="collapse">
                                    
                                    <li class="<?php if($cur_page == 'photo.php' || $cur_page == 'photo-add.php' || $cur_page == 'photo-edit.php') {echo 'active';} ?>">
                                        <a href="photo.php">Photos</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'video.php' || $cur_page == 'video-add.php' || $cur_page == 'video-edit.php') {echo 'active';} ?>">
                                        <a href="video.php">Videos</a>
                                    </li>

                                </ul>
                            </li>


                            <li class="<?php if($cur_page == 'product.php' || $cur_page == 'product-add.php' || $cur_page == 'product-edit.php' || $cur_page == 'shipping.php' || $cur_page == 'shipping-add.php' || $cur_page == 'shipping-edit.php'||$cur_page == 'coupon.php' || $cur_page == 'coupon-add.php' || $cur_page == 'coupon-edit.php') {echo 'active';} ?>">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-shopping-cart"></i><span>Product</span></a>
                                <ul class="collapse">
                                    
                                    <li class="<?php if($cur_page == 'product.php' || $cur_page == 'product-add.php' || $cur_page == 'product-edit.php') {echo 'active';} ?>">
                                        <a href="product.php">Product</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'shipping.php' || $cur_page == 'shipping-add.php' || $cur_page == 'shipping-edit.php') {echo 'active';} ?>">
                                        <a href="shipping.php">Shipping</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'coupon.php' || $cur_page == 'coupon-add.php' || $cur_page == 'coupon-edit.php') {echo 'active';} ?>">
                                        <a href="coupon.php">Coupon</a>
                                    </li>

                                </ul>
                            </li>

                            
                            <li class="<?php if($cur_page == 'order-pending.php' || $cur_page == 'order-completed.php'||$cur_page == 'order-detail.php'||$cur_page == 'order-invoice.php') {echo 'active';} ?>">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-shopping-cart"></i><span>Order</span></a>
                                <ul class="collapse">
                                    
                                    <li class="<?php if($cur_page == 'order-pending.php') {echo 'active';} ?>">
                                        <a href="order-pending.php">Pending Orders</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'order-completed.php') {echo 'active';} ?>">
                                        <a href="order-completed.php">Completed Orders</a>
                                    </li>

                                </ul>
                            </li>

                            <li class="<?php if($cur_page == 'customer-pending.php' || $cur_page == 'customer-active.php' || $cur_page == 'customer-change-status.php' || $cur_page == 'customer-delete.php') {echo 'active';} ?>">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>Customers</span></a>
                                <ul class="collapse">
                                    
                                    <li class="<?php if($cur_page == 'customer-pending.php') {echo 'active';} ?>">
                                        <a href="customer-pending.php">Pending Customers</a>
                                    </li>

                                    <li class="<?php if($cur_page == 'customer-active.php') {echo 'active';} ?>">
                                        <a href="customer-active.php">Active Customers</a>
                                    </li>

                                </ul>
                            </li>

                            <li class="<?php if($cur_page == 'symptom.php' || $cur_page == 'symptom-add.php' || $cur_page == 'symptom-edit.php') {echo 'active';} ?>">
                                <a href="symptom.php">
                                    <i class="ti-sharethis"></i><span>Symptom</span>
                                </a>
                            </li>

                            <li class="<?php if($cur_page == 'prevention.php' || $cur_page == 'prevention-add.php' || $cur_page == 'prevention-edit.php') {echo 'active';} ?>">
                                <a href="prevention.php">
                                    <i class="ti-view-grid"></i><span>Prevention</span>
                                </a>
                            </li>

                            <li class="<?php if($cur_page == 'doctor.php' || $cur_page == 'doctor-add.php' || $cur_page == 'doctor-edit.php') {echo 'active';} ?>">
                                <a href="doctor.php">
                                    <i class="ti-user"></i><span>Doctor</span>
                                </a>
                            </li>

                            <li class="<?php if($cur_page == 'faq.php' || $cur_page == 'faq-add.php' || $cur_page == 'faq-edit.php') {echo 'active';} ?>">
                                <a href="faq.php">
                                    <i class="ti-layers"></i><span>FAQ</span>
                                </a>
                            </li>

                            <li class="<?php if($cur_page == 'email-template.php'||$cur_page == 'email-template-edit.php') {echo 'active';} ?>">
                                <a href="email-template.php">
                                    <i class="ti-email"></i><span>Email Template</span>
                                </a>
                            </li>

                            <li class="<?php if($cur_page == 'subscriber.php') {echo 'active';} ?>">
                                <a href="subscriber.php">
                                    <i class="ti-bolt"></i><span>Subscriber</span>
                                </a>
                            </li>
                            
                            <li class="<?php if($cur_page == 'social-media.php') {echo 'active';} ?>">
                                <a href="social-media.php">
                                    <i class="ti-world"></i><span>Social Media</span>
                                </a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Sidebar menu area end -->


        <!-- Main content area start -->
        <div class="main-content">

            <!-- Header area start -->
            <div class="header-area do-not-print">
                <div class="row align-items-center full-area">

                    <div class="col-md-6 col-sm-8 clearfix left">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-4 clearfix right">
                        <ul class="notification-area pull-right">
                            <li><a href="../" class="btn btn-info">Visit Website</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Header area end -->