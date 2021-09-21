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
		<h1>Delivery Track</h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Delivery Track</li>
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
			<div class="col-md-9">
				
				<form action="" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Enter Order No</label>
								<input type="text" class="form-control" name="order_no" required>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary" name="form1">Submit</button>
				</form>

				<?php
				if(isset($_POST['form1'])):

				$order_no = sanitize_string($_POST['order_no']);
				$q = $pdo->prepare("SELECT * FROM tbl_order_delivery WHERE order_no=? ORDER BY delivery_id ASC");
				$q->execute([$order_no]);
				$tot = $q->rowCount();
				?>

				<?php if($tot == 0): ?>
				<div class="text-danger mt_30">No result is found!</div>
				<?php else: ?>
				<h4 class="mt_30">Delivery Status for Order No: <?php echo safe_data($order_no); ?></h4>
				<div class="table-responsive-md">
					<table class="table table-bordered" id="example">
						<thead>
							<tr class="table-info">
								<th scope="col">Serial</th>
								<th scope="col">Delivery Status</th>
								<th scope="col">Delivery Note</th>
								<th scope="col">Date</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$i=0;
								$res = $q->fetchAll();
								foreach ($res as $row) {
									$i++;
									?>
									<tr>
										<td><?php echo safe_data($i); ?></td>
										<td><?php echo safe_data($row['delivery_status']); ?></td>
										<td>
											<?php if($row['delivery_note'] == ''): ?>
											No note found!
											<?php else: ?>
											<?php echo safe_data(nl2br($row['delivery_note'])); ?>
											<?php endif; ?>
											
										</td>
										<td><?php echo safe_data($row['delivery_created']); ?></td>
									</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
				<?php endif; ?>

				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>