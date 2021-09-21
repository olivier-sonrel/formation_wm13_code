<?php
$q = $pdo->prepare("SELECT * FROM tbl_setting_sidebar WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$total_recent_news = $row['total_recent_news'];
}
?>
<div class="sidebar">
	<div class="widget">
		<form action="<?php echo BASE_URL; ?>search" method="post">
			<div class="search input-group md-form form-sm form-2 pl-0">
				<input name="search_string" class="form-control my-0 py-1 red-border" type="text" placeholder="Search News ...">
				<div class="input-group-append">
					<button type="submit" name="form_search">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</div>
		</form>
	</div>
	<div class="widget">
		<h3>Categories</h3>
		<div class="type-1">
			<ul>
				<?php
				$q = $pdo->prepare("SELECT * FROM tbl_category WHERE category_status=? ORDER BY category_order ASC");
				$q->execute(['Active']);
				$res = $q->fetchAll();
				foreach ($res as $row) {
					$category_detail_url = BASE_URL.'category/'.$row['category_slug'];
					?>
					<li><a href="<?php echo safe_data($category_detail_url); ?>"><?php echo safe_data($row['category_name']); ?></a></li>
					<?php
				}
				?>
			</ul>
		</div>
	</div>
	<div class="widget">
		<h3>Recent Posts</h3>
		<div class="type-2">
			<ul>
				<?php
				$i=0;
				$q = $pdo->prepare("SELECT * FROM tbl_news WHERE news_status=? ORDER BY news_order ASC");
				$q->execute(['Active']);
				$res = $q->fetchAll();
				foreach ($res as $row) {
					$i++;
					if($i>$total_recent_news)
					{
						break;
					}
					$news_detail_url = BASE_URL.'news/'.$row['news_slug'];
					?>
					<li>
						<img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($row['photo']); ?>">
						<a href="<?php echo safe_data($news_detail_url); ?>"><?php echo safe_data($row['news_title']); ?></a>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
	</div>
</div>