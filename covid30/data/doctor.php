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
	$statement = $pdo->prepare("SELECT * FROM tbl_doctor WHERE slug=?");
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
	$banner_doctor_detail = $row['banner_doctor_detail'];
}

// Getting the detailed data of a service from slug
$statement = $pdo->prepare("SELECT * FROM tbl_doctor WHERE slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll();				
foreach ($result as $row)
{
	$name              = $row['name'];
    $slug              = $row['slug'];
    $designation       = $row['designation'];
    $degree            = $row['degree'];
    $detail            = $row['detail'];
    $practice_location = $row['practice_location'];
    $advice            = $row['advice'];
    $facebook          = $row['facebook'];
    $twitter           = $row['twitter'];
    $linkedin          = $row['linkedin'];
    $youtube           = $row['youtube'];
    $instagram         = $row['instagram'];
    $email             = $row['email'];
    $phone             = $row['phone'];
    $website           = $row['website'];
    $address           = $row['address'];
    $video_youtube     = $row['video_youtube'];
    $photo             = $row['photo'];
    $doctor_order      = $row['doctor_order'];
    $status            = $row['status'];
    $meta_title        = $row['meta_title'];
    $meta_description  = $row['meta_description'];
}

$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_layout=?");
$statement->execute(['Doctor Page Layout']);
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

<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($banner_doctor_detail); ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1><?php echo safe_data($name); ?></h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>page/<?php echo safe_data($page_slug); ?>"><?php echo safe_data($page_name); ?></a></li>
			    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($name); ?></li>
		  	</ol>
		</nav>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<div class="row team-single">
			<div class="col-md-4">
                <div class="team-member-photo">
                    <img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($photo); ?>" alt="">
                </div>
            </div>
            <div class="col-md-8">
				<div class="table-responsive">
					<table class="table table-bordered">
                        <tr>
                            <td>Name</td>
                            <td><?php echo safe_data($name); ?></td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td><?php echo safe_data($designation); ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                            	<?php echo nl2br($address); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo safe_data($email); ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td><?php echo safe_data($phone); ?></td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td><?php echo safe_data($website); ?></td>
                        </tr>

                        <?php if($facebook != '' || $twitter != '' || $linkedin != '' || $youtube != '' || $instagram != ''): ?>
                        <tr>
                            <td>Social Media</td>
                            <td>
                            	<ul class="doc_detail_social">
                            		
                            		<?php if($facebook!=''): ?>
                            		<li><a href="<?php echo safe_data($facebook); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            		<?php endif; ?>
									
									<?php if($twitter!=''): ?>
                            		<li><a href="<?php echo safe_data($twitter); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            		<?php endif; ?>

                            		<?php if($linkedin!=''): ?>
                            		<li><a href="<?php echo safe_data($linkedin); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            		<?php endif; ?>

                            		<?php if($youtube!=''): ?>
                            		<li><a href="<?php echo safe_data($youtube); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                            		<?php endif; ?>

                            		<?php if($instagram!=''): ?>
                            		<li><a href="<?php echo safe_data($instagram); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            		<?php endif; ?>
                            	</ul>
                            </td>
                        </tr>
                    	<?php endif; ?>

                    </table>
				</div>
            </div>
		</div>
		<div class="row team-single">
			<div class="col-md-12">

				<div class="description mt_30">
					<ul class="nav nav-pills mb-3 nav-doctor" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="pills-tab-1" data-toggle="pill" href="#pills-t-1" role="tab" aria-controls="pills-t-1" aria-selected="true">Degree</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-tab-2" data-toggle="pill" href="#pills-t-2" role="tab" aria-controls="pills-t-2" aria-selected="false">Details</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-tab-3" data-toggle="pill" href="#pills-t-3" role="tab" aria-controls="pills-t-3" aria-selected="false">Practice Location</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-tab-4" data-toggle="pill" href="#pills-t-4" role="tab" aria-controls="pills-t-4" aria-selected="false">Advice</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="pills-tab-5" data-toggle="pill" href="#pills-t-5" role="tab" aria-controls="pills-t-5" aria-selected="false">Video</a>
						</li>
					</ul>
					<div class="tab-content nav-doctor-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-t-1" role="tabpanel" aria-labelledby="pills-tab-1">
							<?php if($degree == ''): ?>
							No Content Found.
							<?php else: ?>
							<?php echo safe_data($degree); ?>
							<?php endif; ?>
						</div>
						<div class="tab-pane fade" id="pills-t-2" role="tabpanel" aria-labelledby="pills-tab-2">
							<?php if($detail == ''): ?>
							No Content Found.
							<?php else: ?>
							<?php echo safe_data($detail); ?>
							<?php endif; ?>
						</div>
						<div class="tab-pane fade" id="pills-t-3" role="tabpanel" aria-labelledby="pills-tab-3">
							<?php if($practice_location == ''): ?>
							No Content Found.
							<?php else: ?>
							<?php echo safe_data($practice_location); ?>
							<?php endif; ?>
						</div>
						<div class="tab-pane fade" id="pills-t-4" role="tabpanel" aria-labelledby="pills-tab-4">
							<?php if($advice == ''): ?>
							No Content Found.
							<?php else: ?>
							<?php echo safe_data($advice); ?>
							<?php endif; ?>
						</div>
						<div class="tab-pane fade" id="pills-t-5" role="tabpanel" aria-labelledby="pills-tab-5">
							<?php if($video_youtube == ''): ?>
							No Content Found.
							<?php else: ?>
								<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo safe_data($video_youtube); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							<?php endif; ?>
						</div>
					</div>

				</div>
				
			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>