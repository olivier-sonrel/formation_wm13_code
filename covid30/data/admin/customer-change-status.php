<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$q = $pdo->prepare("SELECT * FROM tbl_customer WHERE customer_id=?");
	$q->execute(array($_REQUEST['id']));
	$res = $q->fetchAll();
	$total = $q->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}

foreach ($res as $row) {
	$customer_status = $row['customer_status'];
}

if($customer_status == 'Active') {
	$updated_status = 'Pending';
} else {
	$updated_status = 'Active';
}

$q = $pdo->prepare("UPDATE tbl_customer SET customer_status=? WHERE customer_id=?");
$q->execute([$updated_status,$_REQUEST['id']]);

if($customer_status == 'Active') {
	header('location: customer-active.php');
} else {
	header('location: customer-pending.php');
}
?>