<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_comment WHERE comment_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}

$q = $pdo->prepare("UPDATE tbl_comment SET 
			comment_status=?	
			WHERE comment_id=?
		");
$q->execute([ 
			'Approved',
			$_REQUEST['id'] 
		]);
header('location: comment-approved.php');
?>