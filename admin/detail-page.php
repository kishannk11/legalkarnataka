<?php
require 'navbar.php';
?>
<?php
if (isset($_GET['success'])) {
    $success = $_GET['success'];
    echo '<script>
	document.addEventListener("DOMContentLoaded", function() {
			Swal.fire({
				title: "Success!",
				text: "' . htmlspecialchars($success) . '",
				icon: "success",
				confirmButtonText: "OK"
			});
		});
	</script>';
}

if (isset($_GET['error'])) {
    $error = $_GET['error'];
    echo '<script>
	document.addEventListener("DOMContentLoaded", function() {
		Swal.fire({
			icon: "error",
			title: "Oops...",
			text: "' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '",
		});
	});
</script>';
}
?>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/config.php';
if (isset($_GET['order_id'])) {
    $orderid = $_GET['order_id'];
    $email = $_SESSION['email'];
    $orderDetailsObj = new Order($conn);
    $orderDetails = $orderDetailsObj->getOrderDetailsbyOrderIDadmin($orderid);
    $transactionObj = new Payment($conn);
    $transactiondetails = $transactionObj->getTransDetails($orderid);
}
?>
<div class="ec-content-wrapper">
    <div class="content">

        <div class="breadcrumb-wrapper breadcrumb-wrapper-2">
            <h1>Order Details for
                <?php echo htmlspecialchars($orderid, ENT_QUOTES, 'UTF-8'); ?>
            </h1>
            <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Orders
            </p>
        </div>
        <?php
        if (empty($orderDetails)) {
            echo "No data";
        } else {
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>Order ID</th>

                                            <th>Product Name</th>
                                            <th>Order Stats</th>
                                            <th>Delivery Type</th>

                                            <th>Files</th>
                                            <th>Description</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($orderDetails as $order):
                                            $productObj = new Product($conn);
                                            $products = $productObj->getProductwithId($order['prod_id']);


                                            if ($order['order_id']):
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8'); ?>
                                                        <?php $order['order_status']; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        //foreach ($orderDetails as $orders):
                                                        $productObj = new Product($conn);
                                                        $productname = $productObj->getProductwithId($order['prod_id']);
                                                        foreach ($productname as $product) {
                                                            echo htmlspecialchars($product['prod_name'], ENT_QUOTES, 'UTF-8') . "<br>";

                                                        }
                                                        //endforeach;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        foreach ($orderDetails as $orders):
                                                            echo htmlspecialchars($orders['order_status'], ENT_QUOTES, 'UTF-8');
                                                            break; // Add this line to exit the loop after printing the first value
                                                        endforeach;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        foreach ($orderDetails as $orders):
                                                            echo htmlspecialchars($orders['delivery_type'], ENT_QUOTES, 'UTF-8');
                                                            break;
                                                        endforeach;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $order_file = new Order($conn);
                                                        $orderId = $order['order_id'];
                                                        $orderFiles = $order_file->getOrderFiles($orderId, $order['prod_id']);
                                                        if (empty($orderFiles)) {
                                                            echo "No data";
                                                        } else {
                                                            foreach ($orderFiles as $file) {
                                                                $fileProductId = $file['prod_id'];
                                                                //echo $fileProductId;
                                                                //echo $order['prod_id'];
                                            
                                                                $fileProductName = $productObj->getProductwithId($fileProductId);
                                                                if ($fileProductId == $order['prod_id']) {
                                                                    $fileName = $file['file_name'];
                                                                    $filePath = 'upload/' . htmlspecialchars($fileName, ENT_QUOTES, 'UTF-8');
                                                                    echo '<a href="' . $filePath . '" target="_blank">' . htmlspecialchars($fileName, ENT_QUOTES, 'UTF-8') . '</a><br>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $order_preview = new Order($conn);
                                                        $orderId = $order['order_id'];
                                                        $productId = $order['prod_id'];
                                                        $orderpreview = $order_preview->getPreviewData($orderId, $productId);
                                                        //print_r($orderpreview);
                                                        if (empty($orderpreview)) {
                                                            echo "No data";
                                                        } else {
                                                            foreach ($orderpreview as $filepreview) {
                                                                $label = htmlspecialchars($filepreview['label'], ENT_QUOTES, 'UTF-8');
                                                                $label = htmlspecialchars($filepreview['label'], ENT_QUOTES, 'UTF-8');
                                                                $value = htmlspecialchars($filepreview['value'], ENT_QUOTES, 'UTF-8');
                                                                echo $label . ' : ' . $value . "<br>";
                                                                //}
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            endif;
                                        endforeach;
                                        ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            &nbsp;
            &nbsp;
            <?php
            ?>
            <div class="breadcrumb-wrapper breadcrumb-wrapper-2">
                <h1>User Details </h1>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>Name</th>

                                            <th>Email</th>

                                            <th>Address</th>
                                            <th>Phone</th>


                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $previousEmail = null; // Variable to store the previous email
                                    
                                        foreach ($orderDetails as $order) {
                                            $userInfo = new User($conn);
                                            $userInfoByEmail = $userInfo->getUserByEmail($order['email']);

                                            // Check if the current email is the same as the previous email
                                            if ($order['email'] !== $previousEmail) {
                                                // Display the row only if the email is different
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo htmlspecialchars($order['firstname'], ENT_QUOTES, 'UTF-8'); ?>
                                                        <?php echo htmlspecialchars($order['lastname'], ENT_QUOTES, 'UTF-8'); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlspecialchars($order['email'], ENT_QUOTES, 'UTF-8'); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlspecialchars($order['address'], ENT_QUOTES, 'UTF-8'); ?>
                                                        <?php echo htmlspecialchars($order['city'], ENT_QUOTES, 'UTF-8'); ?>
                                                        <?php echo htmlspecialchars($order['postalcode'], ENT_QUOTES, 'UTF-8'); ?>
                                                        <?php echo htmlspecialchars($order['state'], ENT_QUOTES, 'UTF-8'); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlspecialchars($userInfoByEmail['phonenumber'], ENT_QUOTES, 'UTF-8'); ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }

                                            $previousEmail = $order['email']; // Update the previous email
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            &nbsp;
            &nbsp;
            <div class="breadcrumb-wrapper breadcrumb-wrapper-2">
                <h1>Order Bill</h1>

            </div>
            <div class="ec-odr-dtl card card-default">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6">
                            <address class="info-grid">
                                <div class="info-title"><strong>Shipped To:</strong></div><br>
                                <div class="info-content">
                                    <?php echo htmlspecialchars($orderDetails[0]['firstname']); ?><br>
                                    <?php echo htmlspecialchars($orderDetails[0]['address']); ?><br>
                                    <?php echo htmlspecialchars($orderDetails[0]['city']); ?><br>
                                    <?php echo htmlspecialchars($orderDetails[0]['postalcode']); ?>,<br>
                                    <?php echo htmlspecialchars($orderDetails[0]['state']); ?><br>
                                    <abbr title="Phone">P:</abbr>
                                    <td>
                                        <?php echo htmlspecialchars($userInfoByEmail['phonenumber'], ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                </div>
                            </address>
                        </div>

                        <div class="col-xl-3 col-lg-6">
                            <address class="info-grid">
                                <div class="info-title"><strong>Order Date:</strong></div><br>
                                <div class="info-content">
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
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="tbl-title">PRODUCT SUMMARY</h3>
                            <div class="table-responsive">
                                <table class="table table-striped o-tbl">
                                    <thead>
                                        <tr class="line">
                                            <td><strong>ID</strong></td>
                                            <td><strong>Name</strong></td>
                                            <td><strong>Price</strong></td>
                                            <td><strong>GST(18%)</strong></td>
                                            <td><strong>Stamp Paper Price</strong></td>
                                            <td><strong>Convenience Fee</strong></td>
                                            <td><strong>Convenience Fee with GST(5%)</strong></td>
                                            <td><strong>Amount</strong></td>
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
                                            <td class="border-none m-m15" colspan="6"><span class="note-text-color">
                                                </span></td>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            &nbsp;
            &nbsp;

            &nbsp;
            <div class="breadcrumb-wrapper breadcrumb-wrapper-2">
                <h1>Upload Softcopy </h1>

            </div>
            <div class="row">

                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <form class="row g-3" method="POST" action="upload-softcopy.php" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label">Upload PDF:</label>
                                    <input type="hidden" class="form-control" name="orderid"
                                        value="<?php echo htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="hidden" class="form-control" name="email"
                                        value="<?php echo htmlspecialchars($order['email'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="file" class="form-control" name="image" accept=".pdf">
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="card-body">
                            <?php
                            $actiondetails = $orderDetailsObj->getActionDetailsByOrderId($orderid);
                            //print_r($actiondetails);
                        

                            ?>
                            <div class="col-md-12">
                                <h3 class="tbl-title">Action Details</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped o-tbl">
                                        <thead>
                                            <tr class="line">
                                                <th class="text-center">Order ID</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($actiondetails as $action) {
                                                ?>
                                                <tr class="text-center">
                                                    <td>
                                                        <?php echo htmlspecialchars($action['orderid']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlspecialchars($action['email']); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlspecialchars($action['action']); ?>
                                                    </td>
                                                </tr>
                                                <?php
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
            &nbsp;
            &nbsp;

            &nbsp;
            <div class="breadcrumb-wrapper breadcrumb-wrapper-2">
                <h1>Update Delivery Status</h1>

            </div>
            <div class="row">

                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="New" <?php if ($orders['order_status'] == 'New')
                                        echo 'selected="selected"'; ?>>New</option>
                                    <option value="Shipped" <?php if ($orders['order_status'] == 'Shipped')
                                        echo 'selected="selected"'; ?>>Shipped</option>
                                    <option value="Delivered" <?php if ($orders['order_status'] == 'Delivered')
                                        echo 'selected="selected"'; ?>>Delivered</option>
                                </select>
                            </div>
                            <button id="statusUpdateButton" type="button" class="btn btn-primary">Submit</button>

                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>
                        <?php
                        include "footer.php";
                        ?>
                    </p>
                </div>
            </footer>
            <?php
        }
        ?>
    </div> <!-- End Page Wrapper -->
</div> <!-- End Wrapper -->
<script>
    $(document).ready(function () {
        $("#statusUpdateButton").on("click", function (event) {
            event.preventDefault();

            var status = $("#status").val();
            var orderId = "<?php echo htmlspecialchars($orderid, ENT_QUOTES, 'UTF-8'); ?>"; // You need to get the order ID here

            $.ajax({
                url: "update_status.php",
                type: "POST",
                data: {
                    status: status,
                    order_id: orderId
                },
                success: function (data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Status updated successfully'
                    });
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred'
                    });
                }
            });
        });
    });
</script>
<!-- Common Javascript -->
<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/plugins/simplebar/simplebar.min.js"></script>
<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
<script src="assets/plugins/slick/slick.min.js"></script>

<!-- Data-Tables -->
<script src='assets/plugins/data-tables/jquery.datatables.min.js'></script>
<script src='assets/plugins/data-tables/datatables.bootstrap5.min.js'></script>
<script src='assets/plugins/data-tables/datatables.responsive.min.js'></script>

<!-- Option Switcher -->
<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>
<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="assets/pages/jquery.sweet-alert.init.js"></script>
<!-- Ekka Custom -->
<script src="assets/js/ekka.js"></script>
</body>

</html>