<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_subscriber WHERE subs_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}

$q = $pdo->prepare("UPDATE tbl_subscriber SET 
			subs_active=?,
			subs_hash=?
			WHERE subs_id=?
		");
$q->execute([ 
			1,
			'',
			$_REQUEST['id'] 
		]);
header('location: subscriber.php');
?>