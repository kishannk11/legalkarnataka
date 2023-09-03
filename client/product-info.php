<?php
include('navbar.php');
?>

<?php
include 'config/config.php';
$productObj = new Product($conn);
$id = $_GET['id'];
$products = $productObj->getProductwithId($id);
$producttemplate = $productObj->getProductData($id);
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
                            <li class="ec-breadcrumb-item"><a href="#">Home</a></li>
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
    <div class="checkout_page">
        <div class="container">
            <div class="row">
                <div class="ec-pro-rightside ec-common-rightside col-lg-12 order-lg-last col-md-12 order-md-first">

                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="single-pro-img">
                                    <div class="single-product-scroll">
                                        <div class="single-product-cover">
                                            <div class="single-slide zoom-image-hover">
                                                <div class="image-container">
                                                    <img class="img-responsive"
                                                        src="../admin/upload/<?php echo $products[0]['image']; ?>"
                                                        alt="">
                                                </div>
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
                                            <?php foreach ($producttemplate as $product): ?>
                                                <?php echo $product['template_fields']['template_fields']; ?>
                                            <?php endforeach; ?>

                                        </div>
                                        <div class="ec-single-desc">
                                            <form method="POST" action="product-checkout.php">
                                                <div id="displayPrice">
                                                    <b><label class="form-label">Stamp Paper Price</label></b>
                                                    <input type="text" class="form-control" name="price"
                                                        id="displayPrice1" readonly>
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
                </div>
            </div>
            <div class="ec-single-pro-tab">
                <div class="ec-single-pro-tab-wrapper">
                    <div class="ec-single-pro-tab-nav">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-details"
                                    role="tablist">Detail</a>
                            </li>

                        </ul>
                    </div>
                    <div class="tab-content  ec-single-pro-tab-content">
                        <div id="ec-spt-nav-details" class="tab-pane fade show active">
                            <div class="ec-single-pro-tab-desc">
                                <p>

                                </p>
                                <ul>
                                    <li>
                                        <?php echo $products[0]['details'] ?>
                                    </li>

                            </div>
                        </div>
                        <div id="ec-spt-nav-info" class="tab-pane fade">
                            <div class="ec-single-pro-tab-moreinfo">
                                <ul>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>


<?php
include('footer.php');
?>