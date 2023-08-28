<?php
include('navbar.php');
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/config.php';
include '../admin/Database.php';
$product = new Product($conn);
$products = $product->getProduct();
$productObj = new Product($conn);
$id = $products[0]['id']; // Replace with the actual ID
$productData = $productObj->getProductData($id);
?>
<?php
$productsPerPage = 12;
$totalProducts = count($products);
$totalPages = ceil($totalProducts / $productsPerPage);

if (isset($_GET['page'])) {
	$currentPage = $_GET['page'];
} else {
	$currentPage = 1;
}

$startIndex = ($currentPage - 1) * $productsPerPage;
$displayedProducts = array_slice($products, $startIndex, $productsPerPage);
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
							<li class="ec-breadcrumb-item active">Services</li>
						</ul>
						<!-- ec-breadcrumb-list end -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Ec breadcrumb end -->
<section class="ec-page-content section-space-p">
	<div class="shop_page">
		<div class="container">
			<div class="row">
				<div class="ec-shop-rightside">
					<!-- Shop Top Start -->
					<div class="ec-pro-list-top d-flex">
						<div class="ec-grid-list">
							<div class="ec-gl-btn">
								<button class="btn sidebar-toggle-icon"><i class="fi-rr-filter"></i></button>
								<button class="btn btn-grid-50 active"><i class="fi-rr-apps"></i></button>
							</div>
						</div>
						<div class="ec-sort-select">
							<span class="sort-by">Filter by</span>
							<div class="ec-select-inner">
								<select name="ec-select" id="ec-select">
									<option selected disabled>Select</option>
									<option value="all">All</option>
									<?php
									foreach ($products as $allproduct) {
										?>
										<option value="<?php echo $allproduct['main_category']; ?>">
											<?php echo $allproduct['main_category']; ?>
										</option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<!-- Shop Top End -->

					<!-- Shop content Start -->
					<div class="shop-pro-content">
						<div class="shop-pro-inner">
							<div class="row" id="filtered-products">
								<?php foreach ($displayedProducts as $allproduct): ?>
									<div class="col-lg-3 col-md-4 col-sm-6 mb-4 pro-gl-content"
										data-category="<?php echo $allproduct['main_category']; ?>">
										<div class="ec-product-inner">
											<div class="ec-pro-image-outer">
												<div class="ec-pro-image">
													<a href="product-left-sidebar.html" class="image">
														<img class="main-image"
															src="../admin/upload/<?php echo $allproduct['image']; ?>"
															alt="Product" width="700" height="350" />
														<img class="hover-image"
															src="../admin/upload/<?php echo $allproduct['image']; ?>"
															alt="Product" width="700" height="350" />
													</a>
												</div>
											</div>
											<div class="ec-pro-content">
												<h5 class="ec-pro-title">
													<a href="product-info.php?id=<?php echo $allproduct['id'] ?>">
														<b>
															<?php echo htmlspecialchars($allproduct['prod_name'], ENT_QUOTES, 'UTF-8'); ?>
														</b>
													</a>
												</h5>
												<span class="ec-price">
													<span class="new-price">₹
														<?php echo $allproduct['price']; ?>
													</span>
												</span>
												<div class="scrollable-div">
													<?php echo htmlspecialchars($allproduct['details'], ENT_QUOTES, 'UTF-8'); ?>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>

						<!-- Ec Pagination Start -->
						<div class="ec-pro-pagination">
							<span>Showing
								<?php echo $startIndex + 1; ?>-
								<?php echo min($startIndex + $productsPerPage, $totalProducts); ?> of
								<?php echo $totalProducts; ?> item(s)
							</span>
							<ul class="ec-pro-pagination-inner">
								<?php for ($i = 1; $i <= $totalPages; $i++) { ?>
									<li><a <?php if ($i == $currentPage)
										echo 'class="active"'; ?>
											href="services.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
								<?php } ?>
								<li><a class="next"
										href="services.php?page=<?php echo min($currentPage + 1, $totalPages); ?>">Next
										<i class="ecicon eci-angle-right"></i></a></li>
							</ul>
						</div>
						<!-- Ec Pagination End -->
					</div>
					<!--Shop content End -->
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	document.getElementById('ec-select').addEventListener('change', function () {
		var selectedCategory = this.value;
		var productElements = document.querySelectorAll('#filtered-products .pro-gl-content');
		productElements.forEach(function (element) {
			if (selectedCategory === 'all' || element.getAttribute('data-category') === selectedCategory) {
				element.style.display = 'block';
			} else {
				element.style.display = 'none';
			}
		});
	});
</script>

<?php
include('footer.php');
?>