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

										<th>Order Status</th>
										<th>Delivery Type</th>
										<th>Payment</th>

										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$slno = 1;
									$orderDetailsByOrderId = array();
									foreach ($orderDetails as $order) {
										echo '<tr>';

										echo "<td  '>{$slno}</td>";
										echo "<td  '>{$order['order_id']}</td>";

										echo "<td  '>{$order['order_status']}</td>";
										echo "<td  '>{$order['delivery_type']}</td>";
										$transactiondetails = $transactionObj->getTransDetails($order['order_id']);
										if (empty($transactiondetails[0]['status'])) {
											$paymentStatus = "<span style='color:red;'>Payment not done</span>";
										} else {
											if ($transactiondetails[0]['status'] == 'success') {
												$paymentStatus = "<span style='color:green;'>{$transactiondetails[0]['status']}</span>";
											} else {
												$paymentStatus = "<span style='color:red;'>{$transactiondetails[0]['status']}</span>";
											}
										}
										echo "<td  '>{$paymentStatus}</td>";

										echo "<td  '>
												<div class='btn-group mb-1'>
													<a href='detail-page.php?order_id={$order['order_id']}' class='btn btn-outline-success'>Info</a>
												</div>
											</td>";
										echo '</tr>';
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