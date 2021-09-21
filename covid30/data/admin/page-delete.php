<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_id=?");
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
	$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll();							
	foreach ($result as $row) {
		$banner = $row['banner'];
	}

	// Unlink the banner
	if($banner!='') {
		unlink('../uploads/'.$banner);	
	}

	// Delete from tbl_page
	$statement = $pdo->prepare("DELETE FROM tbl_page WHERE page_id=?");
	$statement->execute(array($_REQUEST['id']));

	header('location: service.php');
?>