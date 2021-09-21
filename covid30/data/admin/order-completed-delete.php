<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_order WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll();
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}

foreach($result as $row)
{
	$order_no = $row['order_no'];
}

$q = $pdo->prepare("DELETE FROM tbl_order WHERE order_no=?");
$q->execute([$order_no]);

$q = $pdo->prepare("DELETE FROM tbl_order_detail WHERE order_no=?");
$q->execute([$order_no]);

$q = $pdo->prepare("DELETE FROM tbl_order_delivery WHERE order_no=?");
$q->execute([$order_no]);

header('location: order-completed.php');
?>