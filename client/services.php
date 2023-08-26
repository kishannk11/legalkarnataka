<?php
include('navbar.php');
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/config.php';
include '../admin/Database.php';

$mainCategorySql = "SELECT name FROM main_category";
$mainCategoryStmt = $conn->prepare($mainCategorySql);
$mainCategoryStmt->execute();
$categories = $mainCategoryStmt->fetchAll(PDO::FETCH_COLUMN);
$subCategorySql = "SELECT name FROM sub_category WHERE parent_category = :category";
$subCategoryStmt = $conn->prepare($subCategorySql);
$product = new Product($conn);
$products = $product->getProduct();
//$products = array_slice($products, 0, 4);

$productObj = new Product($conn);
$id = $products[0]['id']; // Replace with the actual ID
$productData = $productObj->getProductData($id);
?>
<?php

?>
<!-- Header End  -->

<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="row ec_breadcrumb_inner">
					<div class="col-md-6 col-sm-12">
						<!-- <h2 class="ec-breadcrumb-title">Single Products</h2> -->
					</div>
					<div class="col-md-6 col-sm-12">
						<!-- ec-breadcrumb-list start -->
						<ul class="ec-breadcrumb-list">
							<li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="ec-breadcrumb-item active">Dashboard</li>
						</ul>
						<!-- ec-breadcrumb-list end -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Ec breadcrumb end -->

<!-- Sart Single product -->
<section class="ec-page-content section-space-p">
	<div class="container">
		<div class="row">
			<div class="ec-pro-rightside ec-common-rightside col-lg-9 order-lg-last col-md-12 order-md-first">

				<div class="container">
					<div class="row">


						<!-- START single card -->
						<?php
						foreach ($products as $product) {
							echo '<div class="col-lg-4 col-md-6 col-sm-6">';
							echo '<div class="ec-product-tp">';
							echo '<div class="ec-product-image">';
							echo '<a href="product-info.php?id=' . $product['id'] . '"><img src="../admin/upload/' . $product['image'] . '" class="img-center" alt=""></a>';
							echo '<span class="ec-product-ribbon"></span>';
							echo '<div class="ec-link-icon">';

							echo '</div>';
							echo '</div>';
							echo '<div class="ec-product-body">';
							echo '<h3 class="ec-title"><a href="product-info.php?id=' . $product['id'] . '">' . $product['prod_name'] . '</a></h3>';
							echo '<p class="ec-description">' . $product['details'] . '</p>';
							echo '<div class="ec-price"><span>' . $product['price'] . '</span> </div>';
							echo '<div class="ec-link-btn">';
							echo '<a class="ec-add-to-cart" href="product-info.php?id=' . $product['id'] . '">Checkout</a>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
						}
						?>
						<!-- START single card -->

					</div>
				</div>
			</div>
			<!-- Sidebar Area Start -->

			<div class="ec-pro-leftside ec-common-leftside col-lg-3 order-lg-first col-md-12 order-md-last">
				<div class="ec-sidebar-wrap">
					<!-- Sidebar Category Block -->
					<div class="ec-sidebar-block">
						<div class="ec-sb-title">
							<h3 class="ec-sidebar-title">Category</h3>
						</div>
						<div class="ec-sb-block-content">
							<ul>
								<li>
									<?php foreach ($categories as $category): ?>
										<div class="ec-sidebar-block-item">
											<?php echo $category; ?>
										</div>
										<?php
										$subCategoryStmt->bindParam(':category', $category);
										$subCategoryStmt->execute();
										$subCategories = $subCategoryStmt->fetchAll(PDO::FETCH_COLUMN);
										foreach ($subCategories as $subCategory) {
											echo '<ul style="display: block;">';
											echo '<li>';
											echo '<div class="ec-sidebar-sub-item"><a href="product-left-sidebar.php?id=5">' . $subCategory . '</a></div>';
											echo '</li>';
											echo '</ul>';
										}
										?>
									<?php endforeach; ?>
								</li>
							</ul>
						</div>

					</div>
					<!-- Sidebar Category Block -->
				</div>
			</div>
			<!-- Sidebar Area Start -->
		</div>
	</div>
</section>
<!-- End Single product -->

<?php
include('footer.php');
?>