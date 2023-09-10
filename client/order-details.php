<?php
include 'navbar.php';
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/config.php';
$orderid = $_GET['order_id'];
$cartObj = new Order($conn);
$cartDetails = $cartObj->getOrderDetailsbyOrderID($orderid);
print_r($cartDetails);
?>
<section class="ec-page-content ec-vendor-dashboard section-space-p">
    <div class="container">
        <div class="row">
            <!-- Sidebar Area Start -->

            <div class="ec-shop-rightside col-lg-12 col-md-12">

                <div class="ec-vendor-dashboard-card space-bottom-30">
                    <div class="ec-vendor-card-header">
                        <h5>Order Details</h5>

                    </div>
                    <div class="ec-vendor-card-body">
                        <div class="ec-vendor-card-table">
                            <table class="table ec-table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>

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