<?php
include('navbar.php');
?>

<?php
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
$products = array_slice($products, 0, 3);

$productObj = new Product($conn);
$id = $products[0]['id'];
$productData = $productObj->getProductData($id);
?>
<?php

?>
<?php
session_start();
if (!isset($_SESSION['order_id'])) {
    // Generate a new value for $orderId
    $orderId = rand(100000, 999999);
    // Set the session variable
    $_SESSION['order_id'] = $orderId;
} else {
    // Retrieve the existing value from the session variable
    $orderId = $_SESSION['order_id'];
}
?>
<!-- Header End  -->

<!-- ekka Cart Start -->
<div class="ec-side-cart-overlay"></div>

<!-- ekka Cart End -->

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

                <!-- Single product content Start -->
                <div class="single-pro-block">
                    <div class="single-pro-inner">
                        <div class="row">
                            <div class="single-pro-img">
                                <div class="single-product-scroll">
                                    <div class="single-product-cover">
                                        <div class="single-slide zoom-image-hover">
                                            <img class="img-responsive"
                                                src="../admin/upload/<?php echo $products[0]['image']; ?>" alt="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="single-pro-desc">
                                <div class="single-pro-content">
                                    <h5 class="ec-single-title">
                                        <?php echo $products[0]['prod_name']; ?>
                                    </h5>
                                    <div class="ec-single-rating-wrap">
                                        <b>
                                            ₹
                                            <?php echo $products[0]['price'] ?>
                                        </b>
                                    </div>
                                    <div class="ec-single-desc">
                                        <?php echo $products[0]['details'] ?>
                                    </div>
                                    <div class="ec-single-sales">
                                        <?php foreach ($productData as $product): ?>
                                            <?php echo $product['template_fields']['template_fields']; ?>
                                        <?php endforeach; ?>

                                    </div>
                                    <div class="ec-single-desc">
                                        <form method="POST" action="product-checkout.php">
                                            <div id="displayPrice">
                                                <b><label class="form-label">Stamp Paper Price</label></b>
                                                <input type="text" class="form-control" name="price" id="displayPrice1"
                                                    readonly>
                                            </div>
                                            &nbsp;
                                            &nbsp;
                                            <div class="ec-single-cart">
                                                <div class="button-group">
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                    <button class="btn btn-primary" type="submit">Checkout</button>
                                                </div>
                                            </div>
                                        </form>
                                        &nbsp;
                                        &nbsp;
                                        <div class="button-group">
                                            <button class="btn btn-primary" id="previewButton">Preview</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Additional Files</label>
                                    <input type="file" class="form-control" name="files[]" id="fileInput" multiple>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--Single product content End -->
                <!-- Single product tab start -->
                <div class="ec-single-pro-tab">
                    <div class="ec-single-pro-tab-wrapper">
                        <div class="ec-single-pro-tab-nav">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-details"
                                        role="tablist">Detail</a>
                                </li>

                                <!-- <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-review"
                                            role="tablist">Reviews</a>
                                    </li> -->
                            </ul>
                        </div>
                        <div class="tab-content  ec-single-pro-tab-content">
                            <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                <div class="ec-single-pro-tab-desc">
                                    <p>
                                        <?php echo $products[0]['details'] ?>
                                    </p>
                                    <ul>
                                        <li></li>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <!-- product details description area end -->
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
                                            echo '<div class="ec-sidebar-sub-item"><a href="product-info.php?id=' . $products[0]['id'] . '">' . $subCategory . '</a></div>';
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
                <div class="ec-sidebar-slider">
                    <div class="ec-sb-slider-title">Best Sellers</div>
                    <div class="ec-sb-pro-sl">
                        <div>
                            <?php
                            foreach ($products as $product) {
                                echo '<div class="ec-sb-pro-sl-item">';
                                echo '<a href="product-info.php?id=' . $products[0]['id'] . '" class="sidekka_pro_img"><img src="../admin/upload/' . $product['image'] . '" alt="product" /></a>';
                                echo '<div class="ec-pro-content">';
                                echo '<h5 class="ec-pro-title"><a href="product-info.php?id=' . $products[0]['id'] . '">' . $product['prod_name'] . '</a></h5>';
                                echo '<div class="ec-pro-rating">';

                                echo '</div>';
                                echo '<span class="ec-price">';

                                echo '<span class="new-price">₹ ' . $product['price'] . '</span>';
                                echo '</span>';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar Area Start -->
        </div>
    </div>
</section>
<!-- End Single product -->


<!-- Related Product end -->

<?php
include('footer.php');
?>