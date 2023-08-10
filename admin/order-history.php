<?php
require 'navbar.php';
?>

<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper">
	<div class="content">
		<div class="breadcrumb-wrapper breadcrumb-wrapper-2">
			<h1>Orders History</h1>
			<p class="breadcrumbs"><span><a href="index.html">Home</a></span>
				<span><i class="mdi mdi-chevron-right"></i></span>History
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
										<th>ID</th>
										<th>Customer</th>
										<th>Email</th>
										<th>Items</th>
										<th>Price</th>
										<th>Payment</th>
										<th>Status</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<tr>
										<td>1050</td>
										<td>Johny Markue</td>
										<td>johny@example.com</td>
										<td>3</td>
										<td>$80</td>
										<td>PAID</td>
										<td><span class="mb-2 mr-2 badge badge-secondary">Cancel</span></td>
										<td>2021-10-30</td>
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
													<a class="dropdown-item" href="#">Detail</a>
													<a class="dropdown-item" href="#">Track</a>
													<a class="dropdown-item" href="#">Cancel</a>
												</div>
											</div>
										</td>
									</tr>

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
			Copyright &copy; <span id="ec-year"></span><a class="text-primary"
				href="https://themeforest.net/user/ashishmaraviya" target="_blank"> Ekka Admin
				Dashboard</a>. All Rights Reserved.
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