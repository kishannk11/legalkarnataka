<?php
include 'navbar.php';
?>
<?php

include 'config/config.php';
$orderid = $_GET['order_id'];
$cartObj = new Order($conn);
$productObj = new Product($conn);
$userObj = new User($conn);
$orderDetails = $cartObj->getOrderDetailsbyOrderID($orderid, $_SESSION['email']);
$userdetail = $userObj->getUserByEmail($_SESSION['email']);
$transactionObj = new Payment($conn);
$transactiondetails = $transactionObj->getTransDetails($orderid);
?>
<section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
    <div class="container">
        <div class="row">
            <?php
            if (empty($orderDetails)) {
                ?>
                <h3> No Order details for the particular order</h3>
                <?php
            } else {
                ?>
                <div class="ec-shop-rightside col-lg-12 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Order Details</h5>
                            <div class="ec-header-btn">
                                <a class="btn btn-lg btn-secondary" href="#"
                                    onclick="printSection('print-section')">Print</a>

                            </div>
                        </div>
                        <div class="ec-vendor-card-body padding-b-0" id="print-section">
                            <div class="page-content">
                                <div class="page-header text-blue-d2">
                                    <div class="text-center">
                                        <img src="assets/images/logo/legal-logo.png" alt="Site Logo"
                                            style="width: 100px; height: 100px; display: block; margin: 0 auto;">
                                    </div>
                                </div>

                                <div class="container px-0">
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <hr class="row brc-default-l1 mx-n1 mb-4" />

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="my-2">
                                                        <span class="text-sm text-grey-m2 align-middle">To : </span>
                                                        <span class="text-600 text-110 text-blue align-middle">



                                                            <?php echo htmlspecialchars($orderDetails[0]['firstname']); ?>
                                                        </span>
                                                    </div>
                                                    <div class="text-grey-m2">
                                                        <div class="my-2">
                                                            <?php echo htmlspecialchars($orderDetails[0]['address']); ?>
                                                        </div>
                                                        <div class="my-2">
                                                            <?php echo htmlspecialchars($orderDetails[0]['city']); ?>,<br>
                                                            <?php echo htmlspecialchars($orderDetails[0]['postalcode']); ?>,<br>
                                                            <?php echo htmlspecialchars($orderDetails[0]['state']); ?><br>
                                                        </div>
                                                        <div class="my-2"><b class="text-600">Phone : </b>
                                                            <?php echo $userdetail['phonenumber']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.col -->

                                                <div
                                                    class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                                    <hr class="d-sm-none" />
                                                    <div class="text-grey-m2">


                                                        <div class="my-2"><span class="text-600 text-90">ID : </span>
                                                            <?php echo htmlspecialchars($orderid) ?>
                                                        </div>


                                                        <div class="my-2"><span class="text-600 text-90">Order Date :
                                                            </span>
                                                            <?php echo htmlspecialchars($orderDetails[0]['created_at']) ?>
                                                        </div>
                                                        <div class="my-2"><span class="text-600 text-90">Transaction ID :
                                                            </span>
                                                            <?php
                                                            if (empty($transactiondetails[0]['txnid'])) {
                                                                echo "<span style='color:red;'>Payment not done</span>";
                                                            } else {
                                                                echo htmlspecialchars($transactiondetails[0]['txnid']);
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>

                                        <div class="mt-4">

                                            <div class="text-95 text-secondary-d3">
                                                <div class="ec-vendor-card-table">
                                                    <table class="table ec-table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">ID</th>
                                                                <th scope="col">Name</th>

                                                                <th scope="col" style="width: 10%;">Price</th>
                                                                <th scope="col">GST(18%)</th>
                                                                <th scope="col">Stamp Paper Price</th>
                                                                <th scope="col">Convenience Fee</th>
                                                                <th scope="col">Convenience Fee with GST(5%)</th>
                                                                <th scope="col">Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $serialNumber = 1;
                                                            $totalAmount = 0;
                                                            $taxprice = 0;
                                                            foreach ($orderDetails as $orderdata) {
                                                                $proddata = $productObj->getProductwithId($orderdata['prod_id']);
                                                                foreach ($proddata as $prod) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><span>
                                                                                <?php echo $serialNumber++; ?>
                                                                            </span></td>
                                                                        <td>
                                                                            <span>
                                                                                <?php echo htmlspecialchars($prod['prod_name']); ?>
                                                                            </span>
                                                                        </td>
                                                                        <td><span>
                                                                                ₹
                                                                                <?php echo htmlspecialchars($prod['price']); ?>
                                                                            </span></td>
                                                                        <td><span>
                                                                                ₹
                                                                                <?php echo htmlspecialchars($orderdata['gst_amount']); ?>
                                                                            </span></td>
                                                                        <td><span>
                                                                                ₹
                                                                                <?php echo htmlspecialchars($orderdata['stamp_price']); ?>
                                                                            </span></td>
                                                                        <td><span>
                                                                                ₹
                                                                                <?php echo htmlspecialchars($orderdata['commission']); ?>
                                                                            </span></td>
                                                                        <td><span>
                                                                                ₹
                                                                                <?php echo htmlspecialchars(($orderdata['commission'] * 5) / 100); ?>
                                                                            </span></td>
                                                                        <td><span>
                                                                                ₹
                                                                                <?php echo htmlspecialchars($prod['price'] + $orderdata['stamp_price'] + $orderdata['gst_amount'] + $orderdata['commission'] + (($orderdata['commission'] * 5) / 100)); ?>
                                                                            </span></td>
                                                                    </tr>
                                                                    <?php
                                                                    $totalAmount += $prod['price'] + $orderdata['stamp_price'] + $orderdata['commission'] + (($orderdata['commission'] * 5) / 100) + $orderdata['gst_amount'];
                                                                    //$taxprice = $taxprice + $orderdata['commission'];
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td class="border-none" colspan="6">
                                                                    <span></span>
                                                                </td>
                                                                <td class="border-color" colspan="1">
                                                                    <span><strong>Sub Total</strong></span>
                                                                </td>
                                                                <td class="border-color">
                                                                    <span><b>
                                                                            ₹
                                                                            <?php echo htmlspecialchars($totalAmount); ?>
                                                                        </b></span>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="border-none" colspan="6">
                                                                    <span></span>
                                                                </td>
                                                                <td class="border-color" colspan="1">
                                                                    <span><strong>Delivery Charge</strong></span>
                                                                </td>
                                                                <td class="border-color">
                                                                    <span><b>
                                                                            ₹
                                                                            <?php echo htmlspecialchars($orderdata['delivery_charge']); ?>
                                                                        </b></span>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="border-none m-m15" colspan="6"><span
                                                                        class="note-text-color">Extra
                                                                        note such as company or payment
                                                                        information...</span></td>
                                                                <td class="border-color m-m15" colspan="1">
                                                                    <span><strong>Total</strong></span>
                                                                </td>
                                                                <td class="border-color m-m15">
                                                                    <span><b>
                                                                            ₹
                                                                            <?php echo htmlspecialchars($orderdata['delivery_charge'] + $totalAmount); ?>
                                                                        </b></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-none" colspan="6">
                                                                    <span></span>
                                                                </td>
                                                                <td class="border-color" colspan="1">
                                                                    <span><strong>Payment Status</strong></span>
                                                                </td>
                                                                <td class="border-color">
                                                                    <span><b>

                                                                            <?php
                                                                            if (empty($transactiondetails[0]['status'])) {
                                                                                echo "<span style='color:red;'>Payment not done</span>";
                                                                            } else {
                                                                                if ($transactiondetails[0]['status'] == 'success') {
                                                                                    echo "<span style='color:green;'>" . htmlspecialchars($transactiondetails[0]['status']) . "</span>";
                                                                                } else {
                                                                                    echo "<span style='color:red;'>" . htmlspecialchars($transactiondetails[0]['status']) . "</span>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </b></span>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <?php
            }
            ?>
                                            </div>
                                        </div>
                                    </div>
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
<script>
    function printSection(sectionId) {
        var printContents = document.getElementById(sectionId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<?php
include 'footer.php';
?>