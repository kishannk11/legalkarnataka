<?php
include 'navbar.php';
//include 'deliverycharge.php';
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('config/config.php');
require_once('../admin/Database.php');
$cartObj = new Cart($conn);
$cartDetails = $cartObj->getCartDetails($_SESSION['email']);
$id = $_SESSION['id'];
$userObj = new User($conn);
$user = $userObj->getUserInfo($id);
//print_r($cartDetails);
?>
<?php
if (count($cartDetails) > 0) {
    ?>
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-cart-leftside col-lg-12 col-md-12 ">
                    <!-- cart content Start -->
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <div class="row">
                                <form action="#">
                                    <div class="table-content cart-table-content">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Stamp Price</th>
                                                    <th>Total</th>
                                                    <th>Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;
                                                $gstProduct = 0;
                                                $stampPriceValue = 0; // Variable to store the total value
                                            
                                                foreach ($cartDetails as $cartItem) {
                                                    $productObj = new Product($conn);
                                                    $product = $productObj->getProductwithId($cartItem['product_id']);
                                                    $image = $productObj->getProductImage($cartItem['product_id']);

                                                    $stampPrice = $cartItem['stamp_price'];
                                                    $commission = 0; // Default commission value
                                            
                                                    // Add commission for stamp paper prices based on the table
                                                    if ($stampPrice > 0) {
                                                        if ($stampPrice <= 20) {
                                                            $commission = 10;
                                                        } elseif ($stampPrice <= 50) {
                                                            $commission = 10;
                                                        } elseif ($stampPrice <= 100) {
                                                            $commission = 10;
                                                        } elseif ($stampPrice <= 150) {
                                                            $commission = 20;
                                                        } elseif ($stampPrice <= 200) {
                                                            $commission = 20;
                                                        } elseif ($stampPrice <= 300) {
                                                            $commission = 20;
                                                        } elseif ($stampPrice <= 500) {
                                                            $commission = 30;
                                                        } elseif ($stampPrice <= 1000) {
                                                            $commission = 50;
                                                        } elseif ($stampPrice > 1000) {
                                                            $commission = 100;
                                                        }
                                                        $commission += ($commission * 5) / 100; // Add 5% GST to the commission
                                                    }

                                                    $total += $product[0]['price'] + $stampPrice + $commission;
                                                    $gstProduct += $product[0]['price'];
                                                    $stampPriceValue += $commission;
                                                    ?>
                                                    <tr>
                                                        <td data-label="Product" class="ec-cart-pro-name">
                                                            <a href=""><img class="ec-cart-pro-img mr-4"
                                                                    src="../admin/upload/<?php echo $image[0]; ?>" alt="" />
                                                                <?php echo $product[0]['prod_name']; ?>
                                                            </a>
                                                        </td>
                                                        <td data-label="Price" class="ec-cart-pro-price">
                                                            <span class="amount">₹
                                                                <?php echo $product[0]['price']; ?>
                                                            </span>
                                                        </td>
                                                        <td data-label="Stamp Price" class="ec-cart-pro-subtotal">₹
                                                            <?php echo $stampPrice; ?>
                                                        </td>


                                                        <td data-label="Total" class="ec-cart-pro-subtotal">₹
                                                            <?php echo ($product[0]['price'] + $stampPrice); ?>
                                                        </td>
                                                        <td data-label="Remove" class="ec-cart-pro-remove">
                                                            <a href="#"
                                                                onclick="removeCartItem(<?php echo $cartItem['id']; ?>)">
                                                                <i class="ecicon eci-trash-o"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }

                                                $deliveryCharge = 0; // Example delivery charge
                                                $gstPercentage = 18; // GST percentage
                                            
                                                $totalWithDelivery = $total + $deliveryCharge;
                                                $gstAmount = ($gstProduct * $gstPercentage) / 100;
                                                $totalWithGST = $totalWithDelivery + $gstAmount;

                                                ?>
                                                <tr>
                                                    <td colspan="3" class="ec-cart-pro-subtotal text-right"><strong>Delivery
                                                            Charge:</strong></td>
                                                    <td class="ec-cart-pro-subtotal">₹<strong id="delivery-charge">
                                                            Please enter pincode to see the delivery charge
                                                        </strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="ec-cart-pro-subtotal text-right"><strong> GST
                                                            Amount:</strong></td>
                                                    <td class="ec-cart-pro-subtotal">₹<strong>
                                                            <?php echo intval($gstAmount); ?>
                                                        </strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="ec-cart-pro-subtotal text-right"><strong> Stamp
                                                            Paper Charges
                                                            :</strong></td>
                                                    <td class="ec-cart-pro-subtotal">₹<strong>
                                                            <?php echo intval($stampPriceValue); ?>
                                                        </strong></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="ec-cart-pro-subtotal text-right"><strong>Total
                                                            with GST (
                                                            <?php echo $gstPercentage; ?>%):
                                                        </strong></td>
                                                    <td class="ec-cart-pro-subtotal">₹<strong id="total-with-gst">
                                                            <?php echo $totalWithGST; ?>
                                                        </strong></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
            </div>
        </div>
    </section>
    <section class="ec-page-content section-space-p">
        <div class="checkout_page">
            <div class="container">
                <div class="row">
                    <div class="ec-checkout-leftside col-lg-12 col-md-12 ">
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
                                                        <input type="text" name="firstname"
                                                            placeholder="Enter your first name"
                                                            value="<?php echo $user['firstname'] ?>" required />
                                                    </span>
                                                    <span class="ec-bill-wrap ec-bill-half">
                                                        <label>Last Name*</label>
                                                        <input type="text" name="lastname"
                                                            placeholder="Enter your last name"
                                                            value="<?php echo $user['lastname'] ?>" required />
                                                    </span>
                                                    <span class="ec-bill-wrap ec-bill-half">
                                                        <label>Address</label>
                                                        <textarea name="address" required></textarea>

                                                    </span>
                                                    <span class="ec-bill-wrap ec-bill-half">
                                                        <label>City *</label>
                                                        <input type="text" name="city" placeholder="Address Line 1"
                                                            required />
                                                    </span>
                                                    <span class="ec-bill-wrap ec-bill-half">
                                                        <label>Post Code</label>
                                                        <input type="text" name="postalcode" id="postalcode"
                                                            placeholder="Post Code" required
                                                            onchange="updateDeliveryChargeShip()" />
                                                    </span>
                                                    <span class="ec-bill-wrap ec-bill-half">
                                                        <label>State</label>
                                                        <input type="text" name="state" placeholder="Address Line 1"
                                                            value="Karnataka" required />
                                                    </span>

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
                                                                        <span class="ec-del-opt-head">ShipRocket</span>
                                                                        <input type="radio" id="del1" value="1"
                                                                            name="radio-group" data-charge="0" checked>
                                                                        <label for="del1">Rate - Please enter pincode to see
                                                                            the delivery charge</label>
                                                                    </span>
                                                                    </br>
                                                                    <span>
                                                                        <span class="ec-del-opt-head">Indian Post (till
                                                                            2000km bellow 500grm)</span>
                                                                        <input type="radio" id="del2" value="2"
                                                                            name="radio-group" data-charge="50">
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
                                <!--checkout content End -->
                            </div>
                            <span class="ec-check-order-btn">
                                <button class="btn btn-primary" type="submit">Place Order</button>
                            </span>
                            </form>
                        </div>
                    </div>
                </div>
    </section>
    <?php
} else {
    ?>
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">No Items in the Cart</h2>
                        <h2 class="ec-title">No Items in the Cart</h2>
                        <p class="sub-title mb-3">Please add some Items to the cart to proceed</p>
                    </div>
                </div>
                <div class="ec-common-wrapper">

                </div>
            </div>
        </div>
    </section>
    <?php
}
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function removeCartItem(id) {
        $.ajax({
            url: 'remove-cart.php',
            type: 'POST',
            data: { id: id },
            success: function (response) {
                // Handle the response from the server
                if (response === 'success') {
                    // Item removed successfully
                    swal('Item removed from cart.', '', 'success');
                    // Refresh the cart or update the UI accordingly
                    location.reload(); // Reload the current page
                } else {
                    // Failed to remove item
                    swal('Failed to remove item from cart.', '', 'error');
                }
            },
            error: function () {
                // Error occurred during the AJAX request
                swal('An error occurred while removing the item.', '', 'error');
            }
        });
    }
</script>
<script>
    document.getElementById('del1').addEventListener('change', function () {
        var deliveryCharge = parseInt(this.dataset.charge);
        updateDeliveryCharge(deliveryCharge);
    });

    document.getElementById('del2').addEventListener('change', function () {
        var deliveryCharge = parseInt(this.dataset.charge);
        updateDeliveryCharge(deliveryCharge);
    });
    function updateDeliveryCharge(deliveryCharge) {
        document.getElementById('delivery-charge').textContent = deliveryCharge;
        // Recalculate total with delivery and GST
        var total = <?php echo $total; ?>;
        var gstPercentage = <?php echo $gstPercentage; ?>;
        var gstProduct = <?php echo $gstProduct; ?>;
        var totalWithDelivery = total + parseFloat(deliveryCharge);
        var gstAmount = (gstProduct * gstPercentage) / 100;
        var totalWithGST = totalWithDelivery + gstAmount;
        // Update the total with GST
        document.getElementById('total-with-gst').textContent = totalWithGST;
    }

    function updateDeliveryChargeShip() {
        var pincode = document.getElementById('postalcode').value;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'deliverycharge.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var deliveryCharge = xhr.responseText;
                document.getElementById('delivery-charge').textContent = deliveryCharge;
                // Recalculate total with delivery and GST
                var total = <?php echo $total; ?>;
                var gstPercentage = <?php echo $gstPercentage; ?>;
                var gstProduct = <?php echo $gstProduct; ?>;
                var totalWithDelivery = total + parseFloat(deliveryCharge);
                var gstAmount = (gstProduct * gstPercentage) / 100;
                var totalWithGST = totalWithDelivery + gstAmount;
                // Update the total with GST
                document.getElementById('total-with-gst').textContent = totalWithGST;
                document.getElementById('del1').dataset.charge = deliveryCharge;
                document.getElementById('del1').nextElementSibling.textContent = 'Rate - ' + deliveryCharge;
            }
        };
        xhr.send('pincode=' + encodeURIComponent(pincode));
        // Add loading screen
        document.getElementById('delivery-charge').textContent = 'Loading...';
        document.getElementById('total-with-gst').textContent = 'Loading...';
    }
</script>
<?php
include 'footer.php';
?>