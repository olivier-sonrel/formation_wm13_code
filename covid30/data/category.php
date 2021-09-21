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
	$statement = $pdo->prepare("SELECT * FROM tbl_category WHERE category_slug=?");
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
	$banner_category_detail = $row['banner_category_detail'];
}

// Getting the detailed data of a service from slug
$statement = $pdo->prepare("SELECT * FROM tbl_category WHERE category_slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll();				
foreach ($result as $row)
{
	$category_id   = $row['category_id'];
	$category_name = $row['category_name'];
	$category_slug = $row['category_slug'];
}
?>
<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($banner_category_detail); ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1><?php echo safe_data($category_name); ?></h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item">Category</li>
			    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($category_name); ?></li>
		  	</ol>
		</nav>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="single-section">
					<?php
					$q = $pdo->prepare("SELECT * FROM tbl_news WHERE news_status=? AND category_id=? ORDER BY news_order ASC");
					$q->execute(['Active',$category_id]);
					$res = $q->fetchAll();
					foreach ($res as $row) {
						$news_detail_url = BASE_URL.'news/'.$row['news_slug'];
						?>
						<div class="blog-item">
							<div class="featured-photo">
								<a href="<?php echo safe_data($news_detail_url); ?>"><img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['photo']); ?>"></a>
							</div>
							<div class="text">
								<h2><a href="<?php echo safe_data($news_detail_url); ?>"><?php echo safe_data($row['news_title']); ?></a></h2>
								<p>
									<?php echo safe_data(nl2br($row['news_content_short'])); ?>
								</p>
								<div class="read-more">
									<a href="<?php echo safe_data($news_detail_url); ?>">Read More</a>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<div class="col-md-4">
				<?php require_once('sidebar-news.php'); ?>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>