<?php
include 'navbar.php';
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/config.php';
$email = $_SESSION['email'];
$orderDetailsObj = new Order($conn);
$orderDetails = $orderDetailsObj->getOrderDetailsbyID($email);
//print_r($orderDetails);

?>
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">Dashboard</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="#">Home</a></li>
                            <li class="ec-breadcrumb-item active">My Orders</li>
                        </ul>
                        <!-- ec-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ec-page-content ec-vendor-dashboard section-space-p">
    <div class="container">
        <div class="row">
            <!-- Sidebar Area Start -->

            <div class="ec-shop-rightside col-lg-12 col-md-12">

                <div class="ec-vendor-dashboard-card space-bottom-30">
                    <div class="ec-vendor-card-header">
                        <h5>My Order</h5>

                    </div>
                    <div class="ec-vendor-card-body">
                        <div class="ec-vendor-card-table">
                            <table class="table ec-table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL NO</th>
                                        <th scope="col">ID</th>

                                        <th scope="col">Name</th>

                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $slno = 1;
                                    $currentOrderID = '';
                                    $totalPriceDisplayed = false; // Variable to track if total price has been displayed
                                    foreach ($orderDetails as $order):
                                        $productObj = new Product($conn);
                                        $products = $productObj->getProductwithId($order['prod_id']);
                                        //print_r($products);
                                        foreach ($products as $proddata):
                                            if ($currentOrderID != $order['order_id']) {
                                                // Display a new row for a different order ID
                                                if ($currentOrderID != '') {
                                                    // Display the total price for the previous order if not already displayed
                                                    if (!$totalPriceDisplayed) {
                                                        echo '<tr>';
                                                        echo '<th scope="row"></th>';
                                                        echo '<th scope="row"></th>';
                                                        echo '<td><b></b></td>';
                                                        //echo '<td>' . $orderDetails[$slno - 1]['price'] . '</td>';
                                                        echo '</tr>';
                                                        $totalPriceDisplayed = true;
                                                    }
                                                }
                                                echo '<tr>';
                                                echo '<th scope="row"><span>' . $slno . '</span></th>';
                                                echo '<th scope="row"><a href="order-details.php?order_id=' . $order['order_id'] . '">' . $order['order_id'] . '</a></th>';
                                                echo '<td><span>' . $proddata['prod_name'] . '</span></td>';
                                                echo '<td><span>' . $order['price'] . '</span></td>';
                                                echo '</tr>';
                                                $currentOrderID = $order['order_id'];
                                                $slno += 1;
                                            } else {
                                                // Display additional products for the same order ID
                                                echo '<tr>';
                                                echo '<th scope="row"></th>';
                                                echo '<th scope="row"></th>';
                                                echo '<td><span>' . $proddata['prod_name'] . '</span></td>';
                                                // echo '<td><span>' . $order['price'] . '</span></td>';
                                                echo '</tr>';
                                            }
                                        endforeach;
                                    endforeach;

                                    // Display the total price for the last order if not already displayed
                                    if ($currentOrderID != '' && !$totalPriceDisplayed) {
                                        echo '<tr>';
                                        echo '<th scope="row"></th>';
                                        echo '<th scope="row"></th>';
                                        echo '<td><b>Total Price</b></td>';
                                        // echo '<td>' . $orderDetails['price'] . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';
?>