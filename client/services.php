<?php
include('navbar.php');
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/config.php';
$product = new Product($conn);
$products = $product->getProduct();
$mainCategoryObj = new MainCategory($conn);
$mainCategories = $mainCategoryObj->getMainCategories();
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
							<li class="ec-breadcrumb-item"><a href="#">Home</a></li>
							<li class=" ec-breadcrumb-item active">Services</li>
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
									foreach ($mainCategories as $mainCategory) {
										?>
										<option value="<?php echo $mainCategory['name']; ?>">
											<?php echo $mainCategory['name']; ?>
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
								<?php foreach ($displayedProducts as $allproduct):
									$productimage = new Product($conn);
									$productId = $allproduct['id'];
									$productImages = $productimage->getProductImage($productId);
									//print_r($productImages);
									?>
									<div class="col-lg-3 col-md-4 col-sm-6 mb-4 pro-gl-content" data-category="<?php
									$mainCategoryObj = new MainCategory($conn);
									$mainCategory = $mainCategoryObj->getMainCategoryById($allproduct['main_category']);

									echo $mainCategory['name'];
									?>">
										<div class="ec-product-inner">
											<div class="ec-pro-image-outer">
												<div class="ec-pro-image">
													<a href="#" class="image">

														<div class="product-image">
															<img class="main-image"
																src="../admin/upload/<?php echo $productImages[0]; ?>"
																alt="Product" width="700" height="350" />
															<img class="hover-image"
																src="../admin/upload/<?php echo $productImages[0]; ?>"
																alt="Product" width="700" height="350" />
														</div>

													</a>
												</div>
											</div>
											<div class="ec-pro-content">
												<h6 class="ec-pro-titl">
													<a href="product-info.php?id=<?php echo $allproduct['id'] ?>">
														<div class="product-name">
															<b class="">
																<?php echo htmlspecialchars($allproduct['prod_name'], ENT_QUOTES, 'UTF-8'); ?>
															</b>
														</div>
													</a>
												</h6>
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
											href="services.php?page=<?php echo $i; ?>">
											<?php echo $i; ?>
										</a></li>
								<?php } ?>
								<li><a class="next"
										href="services.php?page=<?php echo htmlspecialchars(min($currentPage + 1, $totalPages), ENT_QUOTES, 'UTF-8'); ?>">Next
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