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

<!-- CONTENT WRAPPER -->
<div class="ec-content-wrapper">
	<div class="content">
		<div class="breadcrumb-wrapper breadcrumb-wrapper-2 breadcrumb-contacts">
			<h1>Main Category</h1>
			<p class="breadcrumbs"><span><a href="index.html">Home</a></span>
				<span><i class="mdi mdi-chevron-right"></i></span>Main Category
			</p>
		</div>
		<div class="row">

			<div class="col-xl-12 col-lg-12">
				<div class="ec-cat-list card card-default mb-24px">
					<div class="card-body">
						<div class="ec-cat-form">
							<h4>Add New Category</h4>

							<form action="add_main_category.php" method="POST">

								<div class="form-group row">
									<label for="text" class="col-12 col-form-label">Name</label>
									<div class="col-12">
										<input id="text" name="main_category" class="form-control here slug-title"
											type="text">
									</div>
								</div>



								<div class="row">
									<div class="col-12">
										<button name="submit" type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>

							</form>

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
				href="https://themeforest.net/user/ashishmaraviya" target="_blank"> Ekka Admin Dashboard</a>. All Rights
			Reserved.
		</p>
	</div>
</footer>

</div> <!-- End Page Wrapper -->

</div> <!-- End Wrapper -->

<!-- Common Javascript -->
<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/plugins/tags-input/bootstrap-tagsinput.js"></script>
<script src="assets/plugins/simplebar/simplebar.min.js"></script>
<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
<script src="assets/plugins/slick/slick.min.js"></script>

<!-- Data Tables -->
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