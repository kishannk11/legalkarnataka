<?php
require 'navbar.php';
?>
<?php
$page = 'users';
$subpage = 'list';
?>
<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper">
	<div class="content">
		<div class="breadcrumb-wrapper breadcrumb-contacts">
			<div>
				<h1>User List</h1>
				<p class="breadcrumbs"><span><a href="index.html">Home</a></span>
					<span><i class="mdi mdi-chevron-right"></i></span>User
				</p>
			</div>
			<div>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser"> Add User
				</button>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="ec-vendor-list card card-default">
					<div class="card-body">
						<div class="table-responsive">
							<table id="responsive-data-table" class="table">
								<thead>
									<tr>

										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
									ini_set('display_errors', 1);
									ini_set('display_startup_errors', 1);
									error_reporting(E_ALL);
									require_once('config/config.php');
									require_once('Database.php');
									$userObj = new User($conn);
									$employees = $userObj->getAllEmployees();
									foreach ($employees as $employee) {
										echo '<tr>';
										//echo '<td><img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="user profile" /></td>';
										echo '<td>' . $employee['firstname'] . ' ' . $employee['lastname'] . '</td>';
										echo '<td>' . $employee['email'] . '</td>';
										echo '<td>' . $employee['phonenumber'] . '</td>';

										echo '<td>';
										echo '<div class="btn-group mb-1">';
										echo '<button type="button" class="btn btn-outline-success">Info</button>';
										echo '<button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">';
										echo '<span class="sr-only">Info</span>';
										echo '</button>';
										echo '<div class="dropdown-menu">';
										echo '<a class="dropdown-item" href="#">Edit</a>';
										echo '<a class="dropdown-item" href="#">Delete</a>';
										echo '</div>';
										echo '</div>';
										echo '</td>';
										echo '</tr>';
									}
									?>



								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Add User Modal  -->
		<div class="modal fade modal-add-contact" id="addUser" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<form>
						<div class="modal-header px-4">
							<h5 class="modal-title" id="exampleModalCenterTitle">Add New User</h5>
						</div>

						<div class="modal-body px-4">
							<div class="form-group row mb-6">
								<label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">User
									Image</label>

								<div class="col-sm-8 col-lg-10">
									<div class="custom-file mb-1">
										<input type="file" class="custom-file-input" id="coverImage" required>
										<label class="custom-file-label" for="coverImage">Choose
											file...</label>
										<div class="invalid-feedback">Example invalid custom file feedback
										</div>
									</div>
								</div>
							</div>

							<div class="row mb-2">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="firstName">First name</label>
										<input type="text" class="form-control" id="firstName" value="John">
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<label for="lastName">Last name</label>
										<input type="text" class="form-control" id="lastName" value="Deo">
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group mb-4">
										<label for="userName">User name</label>
										<input type="text" class="form-control" id="userName" value="johndoe">
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group mb-4">
										<label for="email">Email</label>
										<input type="email" class="form-control" id="email"
											value="johnexample@gmail.com">
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group mb-4">
										<label for="Birthday">Birthday</label>
										<input type="text" class="form-control" id="Birthday" value="10-12-1991">
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group mb-4">
										<label for="event">Address</label>
										<input type="text" class="form-control" id="event" value="Address here">
									</div>
								</div>
							</div>
						</div>

						<div class="modal-footer px-4">
							<button type="button" class="btn btn-secondary btn-pill"
								data-bs-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-primary btn-pill">Save Contact</button>
						</div>
					</form>
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

<!-- Data Tables -->
<script src='assets/plugins/data-tables/jquery.datatables.min.js'></script>
<script src='assets/plugins/data-tables/datatables.bootstrap5.min.js'></script>
<script src='assets/plugins/data-tables/datatables.responsive.min.js'></script>

<!-- Option Switcher -->
<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>

<!-- Ekka Custom -->
<script src="assets/js/ekka.js"></script>
</body>

</html>