<?php require_once('header.php'); ?>

<?php
if(!isset($_POST['search_string']))
{
	header('location: index.php');
	exit;
}

$search_string = strip_tags($_POST['search_string']);

$q = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$banner_search = $row['banner_search'];
}
?>
<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($banner_search); ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1>Search by: <?php echo safe_data($search_string); ?></h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item">Search</li>
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
					$search_string = "%" . $search_string . "%";

					$statement = $pdo->prepare("SELECT * FROM tbl_news WHERE news_title like ? OR news_content like ?");
					$statement->execute(array($search_string,$search_string));
					$total = $statement->rowCount();
					?>

					<?php if(!$total): ?>
					<div class="text-danger">No News is Found</div>
					<?php else: ?>

					<?php
					$res = $statement->fetchAll();
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
					<?php endif; ?>
				</div>
			</div>
			<div class="col-md-4">
				<?php require_once('sidebar-news.php'); ?>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>