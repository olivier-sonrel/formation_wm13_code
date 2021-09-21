<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_order WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}

$q = $pdo->prepare("UPDATE tbl_order SET payment_status=? WHERE id=?");
$q->execute(['Completed',$_REQUEST['id']]);

$q = $pdo->prepare("UPDATE tbl_order_detail SET payment_status=? WHERE order_id=?");
$q->execute(['Completed',$_REQUEST['id']]);

header('location: order-completed.php');
?>