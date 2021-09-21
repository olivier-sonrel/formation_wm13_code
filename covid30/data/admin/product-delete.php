<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php

	// Getting photo ID to unlink from folder
	$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll();							
	foreach ($result as $row) {
		$product_featured_photo = $row['product_featured_photo'];
	}

	// Unlink the photo
	if($product_featured_photo!='') {
		unlink('../uploads/'.$product_featured_photo);
	}

	// Delete from tbl_product
	$statement = $pdo->prepare("DELETE FROM tbl_product WHERE product_id=?");
	$statement->execute(array($_REQUEST['id']));

	header('location: product.php');
?>