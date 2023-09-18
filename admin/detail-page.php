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
    $orderDetails = $orderDetailsObj->getOrderDetailsbyOrderID($orderid, $email);
    // print_r($orderDetails);
}
?>
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2">
            <h1>Order Details </h1>
            <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>Orders
            </p>
        </div>
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

                                        <th>Price</th>
                                        <th>Files</th>
                                        <th>Description</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php

                                    foreach ($orderDetails as $order):
                                        $productObj = new Product($conn);
                                        $products = $productObj->getProductwithId($order['prod_id']);
                                        foreach ($products as $proddata):
                                            ?>
                                            <tr>

                                                <td>
                                                    <?php echo htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8'); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($proddata['prod_name'], ENT_QUOTES, 'UTF-8'); ?>

                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($order['price'], ENT_QUOTES, 'UTF-8'); ?>

                                                </td>
                                                <td>
                                                    <?php
                                                    error_reporting(E_ALL);
                                                    ini_set('display_errors', 1);
                                                    include 'config/config.php';
                                                    $order_file = new Order($conn);
                                                    $orderId = $order['order_id'];
                                                    $orderFiles = $order_file->getOrderFiles($orderId);
                                                    if (empty($orderFiles)) {
                                                        echo "No data";
                                                    } else {
                                                        foreach ($orderFiles as $file) {
                                                            $fileName = $file['file_name'];
                                                            $filePath = 'upload/' . htmlspecialchars($fileName, ENT_QUOTES, 'UTF-8'); // Update the file path accordingly
                                                            echo '<a href="' . $filePath . '" target="_blank">' . htmlspecialchars($fileName, ENT_QUOTES, 'UTF-8') . '</a><br>';
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $order_preview = new Order($conn);
                                                    $orderId = $order['order_id'];
                                                    $orderpreview = $order_preview->getPreviewData($orderId);
                                                    if (empty($orderpreview)) {
                                                        echo "No data";
                                                    } else {
                                                        foreach ($orderpreview as $filepreview) {
                                                            $label = htmlspecialchars($filepreview['label'], ENT_QUOTES, 'UTF-8');
                                                            $value = htmlspecialchars($filepreview['value'], ENT_QUOTES, 'UTF-8');
                                                            echo $label . ' : ' . $value . "<br>";
                                                        }
                                                    }
                                                    ?>
                                                </td>

                                            </tr>
                                            <?php
                                        endforeach;

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

                                    foreach ($orderDetails as $order):
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
                                                <?php
                                                error_reporting(E_ALL);
                                                ini_set('display_errors', 1);
                                                $userObj = new User($conn);
                                                $userinfo = $userObj->getUserByEmail($order['email']);
                                                //print_r($userinfo);
                                            
                                                ?>

                                                <?php echo htmlspecialchars($userinfo['phonenumber'], ENT_QUOTES, 'UTF-8'); ?>

                                            </td>



                                        </tr>
                                        <?php


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
        <div class="breadcrumb-wrapper breadcrumb-wrapper-2">
            <h1>Upload Softcopy </h1>

        </div>
        <div class="row">

            <div class="col-12">
                <div class="card card-default">
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="upload-softcopy.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="hidden" class="form-control" name="orderid"
                                    value="<?php echo htmlspecialchars($order['order_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" class="form-control" name="email"
                                    value="<?php echo htmlspecialchars($order['email'], ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div> <!-- End Content -->
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

    </div> <!-- End Page Wrapper -->
</div> <!-- End Wrapper -->

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