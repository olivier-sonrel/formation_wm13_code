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
	$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE product_slug=?");
	$statement->execute(array($_REQUEST['slug']));
	$total = $statement->rowCount();
	if( $total == 0 )
	{
		header('location: '.BASE_URL);
		exit;
	}
}


if(isset($_POST['form_add_to_cart'])) 
{
	$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE product_id=?");
	$statement->execute(array($_POST['product_id']));
	$result = $statement->fetchAll();							
	foreach ($result as $row) {
		$product_stock = $row['product_stock'];
	}
	if($_POST['product_qty'] > $product_stock):
		$temp_msg = 'Sorry! There are only '.$product_stock.' item(s) in stock';
		echo "<script>Swal.fire({icon: 'error',title: 'Error',html: '".$temp_msg."'})</script>";
	else:
	if(isset($_SESSION['cart_product_id']))
    {
        $arr_cart_product_id = array();
        $arr_cart_product_qty = array();

        $i=0;
        foreach($_SESSION['cart_product_id'] as $value) 
        {
            $i++;
            $arr_cart_product_id[$i] = $value;
        }

        $i=0;
        foreach($_SESSION['cart_product_qty'] as $value) 
        {
            $i++;
            $arr_cart_product_qty[$i] = $value;
        }

        if(in_array($_POST['product_id'],$arr_cart_product_id))
        {
           $error_message1 = 'This product is already added to the shopping cart.';
        } 
        else 
        {
            $i=0;
            foreach($_SESSION['cart_product_id'] as $key => $res) 
            {
                $i++;
            }
            $new_key = $i+1;          

            $_SESSION['cart_product_id'][$new_key] = $_POST['product_id'];
            $_SESSION['cart_product_qty'][$new_key] = $_POST['product_qty'];

            $_SESSION['success_message1'] = 'Product is added to the cart successfully!';
            header('location: '.BASE_URL.'product/'.$_REQUEST['slug']);
        	exit;
        }
        
    }
    else
    {
        $_SESSION['cart_product_id'][1] = $_POST['product_id'];
        $_SESSION['cart_product_qty'][1] = $_POST['product_qty'];

        $_SESSION['success_message1'] = 'Product is added to the cart successfully!';
        header('location: '.BASE_URL.'product/'.$_REQUEST['slug']);
    	exit;
    }
	endif;
}



$q = $pdo->prepare("SELECT * FROM tbl_setting_banner WHERE id=?");
$q->execute([1]);
$res = $q->fetchAll();
foreach ($res as $row) {
	$banner_product_detail = $row['banner_product_detail'];
}

// Getting the detailed data of a service from slug
$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE product_slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll();				
foreach ($result as $row)
{
	$product_id             = $row['product_id'];
	$product_name           = $row['product_name'];
	$product_slug           = $row['product_slug'];
	$product_old_price      = $row['product_old_price'];
	$product_current_price  = $row['product_current_price'];
	$product_stock          = $row['product_stock'];
	$product_content        = $row['product_content'];
	$product_content_short  = $row['product_content_short'];
	$product_return_policy  = $row['product_return_policy'];
	$product_featured_photo = $row['product_featured_photo'];
	$product_order          = $row['product_order'];
	$product_status         = $row['product_status'];
	$meta_title             = $row['meta_title'];
	$meta_description       = $row['meta_description'];
}

$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE page_layout=?");
$statement->execute(['Product Page Layout']);
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

<?php 
if( (isset($error_message1)) && ($error_message1!='') ) {
	echo "<script>Swal.fire({icon: 'error',title: 'Error',html: '".$error_message1."'})</script>";
}
if(isset($_SESSION['success_message1']))
{
	echo "<script>Swal.fire({icon: 'success',title: 'Success',html: '".$_SESSION['success_message1']."'})</script>";
	unset($_SESSION['success_message1']);
}
?>

<div class="page-banner" style="background-image: url(<?php echo BASE_URL; ?>uploads/<?php echo safe_data($banner_product_detail); ?>)">
	<div class="bg-page"></div>
	<div class="text">
		<h1><?php echo safe_data($product_name); ?></h1>
		<nav aria-label="breadcrumb">
		  	<ol class="breadcrumb justify-content-center">
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>">Home</a></li>
			    <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>page/<?php echo safe_data($page_slug); ?>"><?php echo safe_data($page_name); ?></a></a></li>
			    <li class="breadcrumb-item active" aria-current="page"><?php echo safe_data($product_name); ?></li>
		  	</ol>
		</nav>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<div class="row product-detail pt_30 pb_40">
			<div class="col-md-5">
                <div class="photo"><img src="<?php echo BASE_URL; ?>uploads/<?php echo safe_data($product_featured_photo); ?>"></div>
            </div>
            <div class="col-md-7">
            	<form action="" method="post">
                <h2><?php echo safe_data($product_name); ?></h2>
                <p>
                	<a href="javascript:void;" class="stock-available-amount">Stock Available: <?php echo safe_data($product_stock); ?></a>
                </p>
                <p>
                	<?php echo safe_data($product_content_short); ?>
                </p>

                <h2 class="mt_30">Product Price</h2>
                <div class="price">
                	$<?php echo $product_current_price; ?> 
                	<?php if($product_old_price!=''): ?>
                	<del>$<?php echo $product_old_price; ?></del>
                	<?php endif; ?>
                </div>

                <h2 class="mt_30">Quantity</h2>
                <div class="qty">
                	<input type="number" class="form-control" name="product_qty" step="1" min="1" max="" value="1" pattern="[0-9]*" inputmode="numeric">
                </div>
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
				<input type="hidden" name="product_current_price" value="<?php echo $product_current_price; ?>">
                <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                <input type="hidden" name="product_featured_photo" value="<?php echo $product_featured_photo; ?>">

				<?php if($product_stock == 0): ?>
					<a href="javascript:void;" class="stock-empty">Stock is empty</a>
				<?php else: ?>
                <button type="submit" class="btn btn-primary mt_30" name="form_add_to_cart">Add To Cart</button>
				<?php endif; ?>
                </form>
            </div>
		</div>

		<div class="row product-detail pt_30 pb_40">
			<div class="col-md-12">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Description</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Return Policy</a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
						<?php echo safe_data($product_content); ?>
					</div>
					<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
						<?php echo safe_data($product_return_policy); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>