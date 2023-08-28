<?php
include('navbar.php');
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/config.php';
include '../admin/Database.php';
$productObj = new Product($conn);
$id = $_POST['id'];
$price = $_POST['price'];
if (empty($price)) {
    // Get the price from the getProductwithId() method
    $product = $productObj->getProductwithId($id);
    $price = $product[0]['price']; // Assuming the price column name is 'price' in the product table
} else {
    // Add the price from $_POST['price'] to the price obtained from getProductwithId()
    $product = $productObj->getProductwithId($id);
    $price += $product[0]['price']; // Assuming the price column name is 'price' in the product table
}
?>
<?php include 'delivery.php'; ?>
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
    <div class="checkout_page">
        <div class="container">
            <div class="row">
                <div class="ec-checkout-leftside col-lg-8 col-md-12 ">
                    <!-- checkout content Start -->
                    <div class="ec-checkout-content">
                        <div class="ec-checkout-inner">

                            <div class="ec-checkout-wrap margin-bottom-30 padding-bottom-3">
                                <div class="ec-checkout-block ec-check-bill">
                                    <h3 class="ec-checkout-title">Billing Details</h3>
                                    <div class="ec-bl-block-content">
                                        <div class="ec-check-subtitle">Checkout Options</div>

                                        <div class="ec-check-bill-form">
                                            <form action="product-payment.php" method="post">
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>First Name*</label>
                                                    <input type="hidden" name="value" id="hidden-total-amount">
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                    <input type="text" name="firstname"
                                                        placeholder="Enter your first name" required />
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Last Name*</label>
                                                    <input type="text" name="lastname"
                                                        placeholder="Enter your last name" required />
                                                </span>
                                                <span class="ec-bill-wrap">
                                                    <label>Address</label>
                                                    <input type="text" name="address" placeholder="Address Line 1" />
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>City *</label>
                                                    <input type="text" name="city" placeholder="Address Line 1" />
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Post Code</label>
                                                    <input type="text" name="postalcode" placeholder="Post Code" />
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>Country *</label>
                                                    <input type="text" name="country" placeholder="Address Line 1" />
                                                </span>
                                                <span class="ec-bill-wrap ec-bill-half">
                                                    <label>State</label>
                                                    <input type="text" name="state" placeholder="Address Line 1" />
                                                </span>
                                                <div class="ec-sidebar-wrap ec-checkout-del-wrap">
                                                    <!-- Sidebar Summary Block -->
                                                    <div class="ec-sidebar-block">
                                                        <div class="ec-sb-title">
                                                            <div class="ec-check-subtitle">Delivery Options

                                                            </div>
                                                        </div>
                                                        <div class="ec-sb-block-content">
                                                            <div class="ec-checkout-del">
                                                                <div class="ec-del-desc">Please select the preferred
                                                                    shipping method to use on this
                                                                    order.</div>

                                                                <span class="ec-del-option">
                                                                    <span>
                                                                        <span class="ec-del-opt-head">Dunzo</span>
                                                                        <input type="radio" id="del1" name="radio-group"
                                                                            checked>
                                                                        <label for="del1">Rate - 100</label>
                                                                    </span>
                                                                    <span>
                                                                        <span class="ec-del-opt-head">Indian Post</span>
                                                                        <input type="radio" id="del2"
                                                                            name="radio-group">
                                                                        <label for="del2">Rate - 50</label>
                                                                    </span>
                                                                </span>


                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <span class="ec-check-order-btn">
                                <button class="btn btn-primary" type="submit">Place Order</button>
                            </span>
                            </form>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-checkout-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Summary</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-checkout-summary">

                                    <div>
                                        <span class="text-left">
                                            <?php echo $product[0]['prod_name']; ?>
                                        </span>
                                        <span class="text-right">
                                            ₹
                                            <?php echo $price; ?>
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-left">Delivery Charges</span>
                                        <span id="delivery-price" class="text-right"></span>
                                    </div>
                                    <div>
                                        <span class="text-left">GST</span>
                                        <span id="gst-amount" class="text-right"></span>
                                    </div>
                                    <div class="ec-checkout-summary-total">
                                        <span class="text-left">Total Amount</span>
                                        <span id="total-amount" class="text-right"></span>
                                    </div>
                                </div>
                                <div class="ec-checkout-pro">
                                    <div class="col-sm-12 mb-6">
                                        <div class="ec-product-inner">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image">
                                                    <a href="" class="image">
                                                        <img class="main-image"
                                                            src="../admin/upload/<?php echo $product[0]['image']; ?>"
                                                            alt="Product" />

                                                    </a>
                                                </div>
                                            </div>
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title"><a
                                                        href="product-info.php?id=<?php echo $product[0]['id'] ?>">
                                                        <?php echo $product[0]['prod_name']; ?>
                                                    </a></h5>

                                                <span class="ec-price">
                                                    <span class="new-price">
                                                        ₹
                                                        <?php echo $price; ?>
                                                    </span>
                                                </span>
                                                <div class="ec-pro-option">
                                                    <div class="ec-pro-color">
                                                        <span class="ec-pro-opt-label">Color</span>

                                                    </div>
                                                    <div class="ec-pro-size">
                                                        <span class="ec-pro-opt-label">Size</span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function initializeDeliveryPrice() {
        const deliveryRadios = document.querySelectorAll('input[name="radio-group"]');
        const deliveryPrice = document.getElementById('delivery-price');
        const gstAmountElement = document.getElementById('gst-amount');
        const totalAmountElement = document.getElementById('total-amount');
        const hiddenTotalAmountInput = document.getElementById('hidden-total-amount');

        deliveryRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked) {
                    const rate = radio.nextElementSibling.textContent.split(' - ')[1];
                    deliveryPrice.textContent = '₹' + rate;
                    calculateTotalAmount();
                }
            });

            // Set the default selected button and display the corresponding price
            if (radio.checked) {
                const rate = radio.nextElementSibling.textContent.split(' - ')[1];
                deliveryPrice.textContent = '₹' + rate;
                calculateTotalAmount();
            }
        });

        function calculateTotalAmount() {
            const price = <?php echo $price; ?>;
            const deliveryCharges = parseFloat(deliveryPrice.textContent.replace('₹', ''));
            const gstPercentage = 18;
            const gstAmount = (deliveryCharges * gstPercentage) / 100;
            const totalAmount = price + deliveryCharges + gstAmount;

            gstAmountElement.textContent = '₹' + gstAmount.toFixed(2);
            totalAmountElement.textContent = '₹' + totalAmount.toFixed(2);
            hiddenTotalAmountInput.value = totalAmount.toFixed(2); // Set the value of the hidden input field
        }
    }

    document.addEventListener('DOMContentLoaded', initializeDeliveryPrice);
</script>

<?php
include('footer.php');
?>