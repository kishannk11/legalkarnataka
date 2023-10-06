<?php
require 'navbar.php';
?>
<?php
require_once('config/config.php');
require_once('Database.php');
$userObj = new User($conn);
$totalUsersCount = $userObj->getTotalUsersCount();
$order = new Order($conn);
$totalOrders = $order->getTotalOrderCount();
$lastemployee = $userObj->getLastFiveEmployees();
$totalRevenue = $order->getTotalRevenue();
$orderDetails = $order->getOrderDetails();
$transactionObj = new Payment($conn);
?>
<!--  PAGE WRAPPER -->

<div class="ec-content-wrapper">
	<div class="content">
		<!-- Top Statistics -->
		<div class="row">
			<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
				<div class="card card-mini dash-card card-1">
					<div class="card-body">

						<h2 class="mb-1">
							<?php echo $totalUsersCount ?>
						</h2>
						<p>Total Signups</p>
						<span class="mdi mdi-account-arrow-left"></span>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
				<div class="card card-mini dash-card card-2">
					<div class="card-body">
						<h2 class="mb-1">
							<?php echo $order->getNewOrderCount(); ?>
						</h2>
						<p>Total New Orders</p>
						<span class="mdi mdi-account-clock"></span>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
				<div class="card card-mini dash-card card-3">
					<div class="card-body">
						<h2 class="mb-1">
							<?php echo $totalOrders; ?>
						</h2>
						<p>Total Order</p>
						<span class="mdi mdi-package-variant"></span>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
				<div class="card card-mini dash-card card-4">
					<div class="card-body">
						<h2 class="mb-1">
							<?php echo $totalRevenue; ?>
						</h2>
						<p>Total Revenue</p>
						<span class="mdi mdi-currency-usd"></span>
					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-12 p-b-15">

				<div class="card card-table-border-none card-default recent-orders" id="recent-orders">
					<div class="card-header justify-content-between">
						<h2>Recent Orders</h2>

					</div>
					<div class="card-body pt-0 pb-5">
						<table class="table card-table table-responsive table-responsive-large" style="width:100%">
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
									if (!isset($orderDetailsByOrderId[$orderId])) {
										$orderDetailsByOrderId[$orderId] = array();
									}
									$orderDetailsByOrderId[$orderId][] = $order;
								}

								foreach ($orderDetailsByOrderId as $orderId => $orders) {
									$rowspan = count($orders);
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
												if (empty($transactiondetails[0]['status'])) {
													$paymentStatus = "<span style='color:red;'>Payment not done</span>";
												} else {
													if ($transactiondetails[0]['status'] == 'success') {
														$paymentStatus = "<span style='color:green;'>{$transactiondetails[0]['status']}</span>";
													} else {
														$paymentStatus = "<span style='color:red;'>{$transactiondetails[0]['status']}</span>";
													}
												}
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

		<div class="row">
			<div class="col-xl-5">
				<!-- New Customers -->
				<div class="card ec-cust-card card-table-border-none card-default">
					<div class="card-header justify-content-between ">
						<h2>New Customers</h2>
						<div>

						</div>
					</div>
					<div class="card-body pt-0 pb-15px">
						<table class="table ">
							<tbody>
							<tbody>
								<?php foreach ($lastemployee as $employee): ?>
									<tr>
										<td>
											<div class="media">
												<div class="media-body align-self-center">
													<h6 class="mt-0 text-dark font-weight-medium">
														<?php echo $employee['firstname'] . ' ' . $employee['lastname']; ?>
													</h6>
												</div>
											</div>
										</td>
										<td>
											<div class="media">
												<div class="media-body align-self-center">
													<h6 class="mt-0 text-dark font-weight-medium">
														<?php echo $employee['email']; ?>
													</h6>
												</div>
											</div>
										</td>
									</tr>

								<?php endforeach; ?>
							</tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="col-xl-7">

			</div>
		</div>
	</div> <!-- End Content -->


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

<!-- Chart -->
<script src="assets/plugins/charts/Chart.min.js"></script>
<script src="assets/js/chart.js"></script>

<!-- Google map chart -->
<script src="assets/plugins/charts/google-map-loader.js"></script>
<script src="assets/plugins/charts/google-map.js"></script>

<!-- Date Range Picker -->
<script src="assets/plugins/daterangepicker/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="assets/js/date-range.js"></script>

<!-- Option Switcher -->
<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

<!-- Ekka Custom -->
<script src="assets/js/ekka.js"></script>
</body>

</html>