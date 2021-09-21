<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_category WHERE category_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php
	// Delete photo from tbl_news
	$q = $pdo->prepare("SELECT * FROM tbl_news WHERE category_id=?");
	$q->execute([$_REQUEST['id']]);
	$res = $q->fetchAll();
	foreach ($res as $row) {
		$photo = $row['photo'];
		unlink('../uploads/'.$photo);
	}

	// Delete from tbl_news
	$statement = $pdo->prepare("DELETE FROM tbl_news WHERE category_id=?");
	$statement->execute(array($_REQUEST['id']));

	// Delete from tbl_category
	$statement = $pdo->prepare("DELETE FROM tbl_category WHERE category_id=?");
	$statement->execute(array($_REQUEST['id']));

	header('location: category.php');
?>