<?php
require 'navbar.php';
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/config.php';
$email = $_SESSION['email'];
$orderDetailsObj = new Order($conn);
$orderDetails = $orderDetailsObj->getOrderDetails();
$transactionObj = new Payment($conn);
?>

<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper">
	<div class="content">
		<div class="breadcrumb-wrapper breadcrumb-wrapper-2">
			<h1>New Orders</h1>
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
										<th>SL No</th>
										<th>Order ID</th>
										<th>Price</th>
										<th>Order Status</th>
										<th>Delivery Type</th>
										<th>Payment</th>
										<th>Product Name</th>
										<th>Files</th>
										<th>Description</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$slno = 1;
									$orderDetailsByOrderId = array();
									foreach ($orderDetails as $order) {
										$orderId = $order['order_id'];
										//echo $orderId;
										if (!isset($orderDetailsByOrderId[$orderId])) {
											$orderDetailsByOrderId[$orderId] = array();
										}
										$orderDetailsByOrderId[$orderId][] = $order;
									}

									foreach ($orderDetailsByOrderId as $orderId => $orders) {
										$rowspan = count($orders);
										//echo $rowspan;
										$firstOrder = true;
										foreach ($orders as $order) {
											$productObj = new Product($conn);
											$products = $productObj->getProductwithId($order['prod_id']);
											foreach ($products as $proddata) {
												echo '<tr>';
												if ($firstOrder) {
													echo "<td rowspan='{$rowspan}'>{$slno}</td>";
													echo "<td rowspan='{$rowspan}'>{$order['order_id']}</td>";
													echo "<td rowspan='{$rowspan}'>{$order['price']}</td>";
													echo "<td rowspan='{$rowspan}'>{$order['order_status']}</td>";
													echo "<td rowspan='{$rowspan}'>{$order['delivery_type']}</td>";
													$transactiondetails = $transactionObj->getTransDetails($orderId);
													$paymentStatus = empty($transactiondetails[0]['status']) ? "Payment Not Done" : $transactiondetails[0]['status'];
													echo "<td rowspan='{$rowspan}'>{$paymentStatus}</td>";
												}
												echo "<td>{$proddata['prod_name']}</td>";
												// Files
												$order_file = new Order($conn);
												$orderFiles = $order_file->getOrderFiles($orderId, $order['prod_id']);
												echo "<td>";
												if (empty($orderFiles)) {
													echo "No data";
												} else {
													foreach ($orderFiles as $file) {
														$fileName = $file['file_name'];
														$filePath = 'upload/' . $fileName; // Update the file path accordingly
														echo '<a href="' . $filePath . '" target="_blank">' . $fileName . '</a><br>';
													}
												}
												echo "</td>";
												// Description
												$order_preview = new Order($conn);
												$orderpreview = $order_preview->getPreviewData($orderId, $order['prod_id']);
												echo "<td>";
												if (empty($orderpreview)) {
													echo "No data";
												} else {
													foreach ($orderpreview as $filepreview) {
														echo $filepreview['label'] . ' : ' . $filepreview['value'] . "<br>";
													}
												}
												echo "</td>";
												if ($firstOrder) {
													echo "<td rowspan='{$rowspan}'>
														<div class='btn-group mb-1'>
															<a href='detail-page.php?order_id={$order['order_id']}' class='btn btn-outline-success'>Info</a>
															
															
														</div>
													</td>";
												}
												echo '</tr>';
												$firstOrder = false;
											}
										}
										$slno += 1;
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- End Content -->
</div> <!-- End Content Wrapper -->

<!-- Footer -->
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

<!-- Ekka Custom -->
<script src="assets/js/ekka.js"></script>
</body>

</html>