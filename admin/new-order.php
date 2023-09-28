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

										<th>Product Name</th>

										<th>Price</th>
										<th>Files</th>
										<th>Description</th>
										<th>Payment</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$slno = 1;
									$orderDetailsByOrderId = array();
									foreach ($orderDetails as $order) {
										$orderId = $order['order_id'];
										if (!isset($orderDetailsByOrderId[$orderId])) {
											$orderDetailsByOrderId[$orderId] = array();
										}
										$orderDetailsByOrderId[$orderId][] = $order;
									}

									foreach ($orderDetailsByOrderId as $orderId => $orders) {
										foreach ($orders as $order) {
											$productObj = new Product($conn);
											$products = $productObj->getProductwithId($order['prod_id']);
											foreach ($products as $proddata) {
												?>
												<tr>
													<td>
														<?php echo $slno ?>
													</td>
													<td>
														<?php echo $order['order_id']; ?>
													</td>
													<td>
														<?php echo $proddata['prod_name']; ?>
													</td>
													<td>
														<?php echo $order['price']; ?>
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
																$filePath = 'upload/' . $fileName; // Update the file path accordingly
																echo '<a href="' . $filePath . '" target="_blank">' . $fileName . '</a><br>';
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
																echo $filepreview['label'] . ' : ' . $filepreview['value'] . "<br>";
															}
														}
														?>
													</td>
													<td>
														<?php
														$transactiondetails = $transactionObj->getTransDetails($orderId);
														//print_r($transactiondetails);
														if (empty($transactiondetails[0]['status']))
															echo "Payment Not Done";
														else
															echo $transactiondetails[0]['status'];
														?>
													</td>
													<td>
														<div class="btn-group mb-1">
															<button type="button" class="btn btn-outline-success">Info</button>
															<button type="button"
																class="btn btn-outline-success dropdown-toggle dropdown-toggle-split"
																data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
																data-display="static">
																<span class="sr-only">Info</span>
															</button>
															<div class="dropdown-menu">
																<a class="dropdown-item"
																	href="detail-page.php?order_id=<?php echo $order['order_id']; ?>">Detail</a>
																<a class="dropdown-item" href="#">Track</a>
																<a class="dropdown-item" href="#">Cancel</a>
															</div>
														</div>
													</td>
												</tr>
												<?php
											}
											$slno += 1;
										}
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