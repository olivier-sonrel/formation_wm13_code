<?php require_once('header.php'); ?>

<?php
$q = $pdo->prepare("SELECT * FROM tbl_customer WHERE customer_email=? AND customer_token=?");
$q->execute([$_REQUEST['email'],$_REQUEST['token']]);
$tot = $q->rowCount();
if($tot)
{
	$q = $pdo->prepare("UPDATE tbl_customer SET 
				customer_token=?, 
				customer_status=?	
				WHERE customer_email=? AND customer_token=?
			");
	$q->execute([
				'',
				'Active',
				$_REQUEST['email'],
				$_REQUEST['token']
			]);
	header('location: '.BASE_URL.'verify-registration-success');
}
else
{
	header('location: '.BASE_URL);
	exit;
}
?>