<?php require_once('header.php'); ?>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
            </div>
        </div>
        <?php require_once('header-profile.php'); ?>
    </div>
</div>

<?php
$q = $pdo->prepare("SELECT * FROM tbl_doctor WHERE status=?");
$q->execute(['Active']);
$total_doctor = $q->rowCount();

$q = $pdo->prepare("SELECT * FROM tbl_prevention WHERE status=?");
$q->execute(['Active']);
$total_prevention = $q->rowCount();

$q = $pdo->prepare("SELECT * FROM tbl_symptom WHERE status=?");
$q->execute(['Active']);
$total_symptom = $q->rowCount();

$q = $pdo->prepare("SELECT * FROM tbl_faq");
$q->execute();
$total_faq = $q->rowCount();

$q = $pdo->prepare("SELECT * FROM tbl_news WHERE news_status=?");
$q->execute(['Active']);
$total_news = $q->rowCount();

$q = $pdo->prepare("SELECT * FROM tbl_page WHERE status=?");
$q->execute(['Active']);
$total_page = $q->rowCount();

?>

<div class="main-content-inner">
    <div class="row">

        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-4 mt-5">
                    <div class="card">
                        <div class="seo-fact sbg1">
                            <div class="p_50 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="ti-user"></i> Doctors</div>
                                <h2><?php echo number_format($total_doctor); ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="card">
                        <div class="seo-fact sbg2">
                            <div class="p_50 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="ti-view-grid"></i> Preventions</div>
                                <h2><?php echo number_format($total_prevention); ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="card">
                        <div class="seo-fact sbg3">
                            <div class="p_50 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="ti-sharethis"></i> Symptoms</div>
                                <h2><?php echo number_format($total_symptom); ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card">
                        <div class="seo-fact sbg1">
                            <div class="p_50 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="ti-layers"></i> FAQs</div>
                                <h2><?php echo number_format($total_faq); ?></h2>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card">
                        <div class="seo-fact sbg2">
                            <div class="p_50 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="ti-layers"></i> News</div>
                                <h2><?php echo number_format($total_news); ?></h2>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card">
                        <div class="seo-fact sbg3">
                            <div class="p_50 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="ti-receipt"></i> Pages</div>
                                <h2><?php echo number_format($total_page); ?></h2>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require_once('footer.php'); ?>