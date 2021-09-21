<?php require_once('header.php'); ?>

<?php
$q = $pdo->prepare("SELECT * FROM tbl_subscriber WHERE subs_email=? AND subs_hash=?");
$q->execute([$_REQUEST['email'],$_REQUEST['hash']]);
$tot = $q->rowCount();
if($tot)
{
	$q = $pdo->prepare("UPDATE tbl_subscriber SET 
				subs_hash=?, 
				subs_active=?	
				WHERE subs_email=? AND subs_hash=?
			");
	$q->execute([
				'',
				1,
				$_REQUEST['email'],
				$_REQUEST['hash']
			]);
	header('location: '.BASE_URL.'verify-subscriber-success');
}
else
{
	header('location: '.BASE_URL);
	exit;
}
?>