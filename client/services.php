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
$products = array_slice($products, 0, 4);

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
				
				<div class="col-lg-4 col-md-6 col-sm-6">
					<!-- START single card -->
					<div class="ec-product-tp">
						<div class="ec-product-image">
							<a href="#">
								<img src="assets/images/product-image/2.jpg" class="img-center" alt="">
							</a>
							<span class="ec-product-ribbon">New</span>
							<div class="ec-link-icon">
								<a href="#" data-tip="Add to Wishlist"><i class="fi-rr-heart"></i></a>
								<a href="#" data-tip="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
								<a href="#" data-tip="Quick View"><i class="fi-rr-eye"></i></a>
							</div>
						</div>
						<div class="ec-product-body">
							<h3 class="ec-title"><a href="#">Full sleeve cap hoodies</a></h3>
							<p class="ec-description">
								Lorem Ipsum is simply dummy text.
							</p>
							<ul class="ec-rating">
								<li class="ecicon eci-star fill"></li>
								<li class="ecicon eci-star fill"></li>
								<li class="ecicon eci-star fill"></li>
								<li class="ecicon eci-star fill"></li>
								<li class="ecicon eci-star"></li>
							</ul>
							<div class="ec-price"><span>$89.00</span> $39.00</div>
							<div class="ec-link-btn">
								<a class=" ec-add-to-cart" href="#">add to cart</a>
							</div>
						</div>
					</div>
					<!-- START single card -->
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<!-- START single card -->
					<div class="ec-product-tp">
						<div class="ec-product-image">
							<a href="#">
								<img src="assets/images/product-image/3.jpg" class="img-center" alt="">
							</a>
							<span class="ec-product-ribbon">New</span>
							<div class="ec-link-icon">
								<a href="#" data-tip="Add to Wishlist"><i class="fi-rr-heart"></i></a>
								<a href="#" data-tip="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
								<a href="#" data-tip="Quick View"><i class="fi-rr-eye"></i></a>
							</div>
						</div>
						<div class="ec-product-body">
							<h3 class="ec-title"><a href="#">Full Sleeve T-Shirt</a></h3>
							<p class="ec-description">
								Lorem Ipsum is simply dummy text.
							</p>
							<ul class="ec-rating">
								<li class="ecicon eci-star fill"></li>
								<li class="ecicon eci-star fill"></li>
								<li class="ecicon eci-star fill"></li>
								<li class="ecicon eci-star fill"></li>
								<li class="ecicon eci-star"></li>
							</ul>
							<div class="ec-price"><span>$45.00</span> $27.00</div>
							<div class="ec-link-btn">
								<a class=" ec-add-to-cart" href="#">add to cart</a>
							</div>
						</div>
					</div>
					<!-- START single card -->
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<!-- START single card -->
					<div class="ec-product-tp">
						<div class="ec-product-image">
							<a href="#">
								<img src="assets/images/product-image/6.jpg" class="img-center" alt="">
							</a>
							<span class="ec-product-ribbon">New</span>
							<div class="ec-link-icon">
								<a href="#" data-tip="Add to Wishlist"><i class="fi-rr-heart"></i></a>
								<a href="#" data-tip="Compare"><i class="fi fi-rr-arrows-repeat"></i></a>
								<a href="#" data-tip="Quick View"><i class="fi-rr-eye"></i></a>
							</div>
						</div>
						<div class="ec-product-body">
							<h3 class="ec-title"><a href="#">Baby toy doctor kit</a></h3>
							<p class="ec-description">
								Lorem Ipsum is simply dummy text.
							</p>
							<ul class="ec-rating">
								<li class="ecicon eci-star fill"></li>
								<li class="ecicon eci-star fill"></li>
								<li class="ecicon eci-star fill"></li>
								<li class="ecicon eci-star fill"></li>
								<li class="ecicon eci-star"></li>
							</ul>
							<div class="ec-price"><span>$49.00</span> $34.00</div>
							<div class="ec-link-btn">
								<a class=" ec-add-to-cart" href="#">add to cart</a>
							</div>
						</div>
					</div>
					<!-- START single card -->
				</div>
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