<?php require_once('header.php'); ?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['slug']))
{
	header('location: '.BASE_URL);
	exit;
}
else
{
	// Check the page slug is valid or not.
	$statement = $pdo->prepare("SELECT * FROM tbl_prevention WHERE slug=?");
	$statement->execute(array($_REQUEST['slug']));
	$total = $statement->rowCount();
	if( $total == 0 )
	{
		header('location: '.BASE_URL);
		exit;
	}
}

$q = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$banner_prevention_detail = $row['banner_prevention_detail'];
}

// Getting the detailed data of a service from slug
$statement = $pdo->prepare("SELECT * FROM tbl_prevention WHERE slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll();				
foreach ($result as $row)
{
	$name              = $row['name'];
	$slug              = $row['slug'];
	$short_description = $row['short_description'];
	$description       = $row['description'];
	$photo             = $row['photo'];
}

$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_layout=?");
$statement->execute(['Prevention Page Layout']);
$tot = $statement->rowCount();
$result = $statement->fetchAll();
foreach ($result as $row)
{
	$page_name = $row['page_name'];
	$page_slug = $row['page_slug'];
}
if(!$tot)
{
	$page_name = '';
	$page_slug = '';
}
?>

<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($banner_prevention_detail); ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1><?php echo safe_data($name); ?></h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <?php if($page_name != '' && $page_slug != ''): ?>
			    	<li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>page/<?php echo safe_data($page_slug); ?>"><?php echo safe_data($page_name); ?></a></li>
			    	<li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($name); ?></li>
				<?php endif; ?>
		  	</ol>
		</nav>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="single-section">
					<div class="featured-photo">
						<img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($photo); ?>">
					</div>
					<div class="text">
						<h2><?php echo safe_data($name); ?></h2>
						<?php echo safe_data($description); ?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<div class="widget">
						<h3>All Prevention Steps</h3>
						<div class="type-2">
							<ul>
								<?php
								$q = $pdo->prepare("SELECT * FROM tbl_prevention WHERE status=? ORDER BY prevention_order ASC");
								$q->execute(['Active']);
								$res = $q->fetchAll();
								foreach ($res as $row) {
									?>
									<li>
										<img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['photo']); ?>">
										<a href="<?php echo BASE_URL; ?>prevention/<?php echo safe_data($row['slug']); ?>"><?php echo safe_data($row['name']); ?></a>
									</li>
									<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>