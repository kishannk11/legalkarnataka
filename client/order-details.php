<?php
include 'navbar.php';
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/config.php';
$orderid = $_GET['order_id'];
$cartObj = new Order($conn);
$productObj = new Product($conn);
$orderDetails = $cartObj->getOrderDetailsbyOrderID($orderid);
print_r($orderDetails);
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
                                        <th scope="col">Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php echo $orderDetails[0]['firstname']; ?>

                                        </td>
                                        <td>
                                            <?php echo $orderDetails[0]['address']; ?>
                                            <?php echo $orderDetails[0]['city']; ?>
                                            <?php echo $orderDetails[0]['postalcode']; ?>
                                            <?php echo $orderDetails[0]['state']; ?>
                                        </td>

                                        <td>
                                            <?php echo $orderDetails[0]['email']; ?>

                                        </td>
                                        <td>
                                            <?php
                                            foreach ($orderDetails as $orderdata) {
                                                $proddata = $productObj->getProductwithId($orderdata['prod_id']);
                                                foreach ($proddata as $prod) {
                                                    echo $prod['prod_name'] . '</br>';
                                                }
                                            }

                                            ?>

                                        </td>
                                        <td>
                                            <?php echo $orderDetails[0]['price']; ?>

                                        </td>
                                    </tr>
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