<?php
include 'navbar.php';
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/config.php';
include '../admin/Database.php';
$email = $_SESSION['email'];
$orderDetailsObj = new Order($conn);
$orderDetails = $orderDetailsObj->getOrderDetailsbyID($email);


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
                            <li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
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
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>

                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $slno = 1;
                                    foreach ($orderDetails as $order):
                                        $productObj = new Product($conn);
                                        $products = $productObj->getProductwithId($order['prod_id']);
                                        foreach ($products as $proddata):


                                            ?>

                                            <tr>
                                                <th scope="row"><span>
                                                        <?php echo $slno; ?>
                                                    </span></th>
                                                <th scope="row"><span>
                                                        <?php echo $order['order_id']; ?>
                                                    </span></th>
                                                <td><img class="prod-img"
                                                        src="../admin/upload/<?php echo $proddata['image']; ?>"
                                                        alt="product image"></td>
                                                <td><span>
                                                        <?php echo $proddata['prod_name']; ?>
                                                    </span></td>


                                                <td><span>
                                                        <?php echo $order['price']; ?>
                                                    </span></td>
                                            </tr>

                                            <?php
                                        endforeach;
                                        $slno += 1;
                                    endforeach;
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