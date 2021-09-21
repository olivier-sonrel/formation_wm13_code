<?php require_once('header.php'); ?>

<?php
// Check if the customer is logged in or not
if(!isset($_SESSION['customer'])) {
    header('location: '.BASE_URL.'logout');
    exit;
} else {
    // If customer is logged in, but admin make him inactive, then force logout this user.
    $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE customer_id=? AND customer_status=?");
    $statement->execute(array($_SESSION['customer']['customer_id'],'Pending'));
    $total = $statement->rowCount();
    if($total) {
        header('location: '.BASE_URL.'logout');
        exit;
    }
}
?>

<?php
$q = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$banner_customer_panel = $row['banner_customer_panel'];
}
?>

<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['banner_customer_panel']); ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1>Dashboard</h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>">Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
		  	</ol>
		</nav>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-3">				
				<div class="user-sidebar">
					<?php require_once('customer-sidebar.php'); ?>
				</div>
			</div>
			<?php
			$q = $pdo->prepare("SELECT * FROM tbl_order WHERE customer_id=? AND payment_status=?");
			$q->execute([$_SESSION['customer']['customer_id'],'Completed']);
			$total_completed_orders = $q->rowCount();

			$q = $pdo->prepare("SELECT * FROM tbl_order WHERE customer_id=? AND payment_status=?");
			$q->execute([$_SESSION['customer']['customer_id'],'Pending']);
			$total_pending_orders = $q->rowCount();
			?>
			<div class="col-md-9">
				<div class="row dashboard-stat">
					<div class="col-md-6 dashboard-stat-item">
                        <div class="bg-info p_20 pt_30 pb_30 text-center text-white">
                            <div class="text">Completed Orders</div>
                            <div class="total"><?php echo $total_completed_orders; ?></div>
                        </div>
					</div>
					<div class="col-md-6 dashboard-stat-item">
                        <div class="bg-info p_20 pt_30 pb_30 text-center text-white">
                            <div class="text">Pending Orders</div>
                            <div class="total"><?php echo $total_pending_orders; ?></div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>