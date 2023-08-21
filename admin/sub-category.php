<?php
require 'navbar.php';
?>
<?php
require_once('config/config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$mainCategoryObj = new MainCategory($conn);
$categories = $mainCategoryObj->getMainCategories();
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
			<h1>Sub Category</h1>
			<p class="breadcrumbs"><span><a href="index.html">Home</a></span>
				<span><i class="mdi mdi-chevron-right"></i></span>Sub Category
			</p>
		</div>
		<div class="row">
			<div class="col-xl-12	 col-lg-12">
				<div class="ec-cat-list card card-default mb-24px">
					<div class="card-body">
						<div class="ec-cat-form">
							<h4>Add Sub Category</h4>

							<form action="add_sub_category.php" method="POST">
								<div class="form-group row">
									<label for="parent-category" class="col-12 col-form-label">Parent Category</label>
									<div class="col-12">
										<select id="parent-category" name="parent-category" class="custom-select">
											<option value="">Select</option>
											<?php foreach ($categories as $category): ?>
												<option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<div class="form-group row">
									<label for="text" class="col-12 col-form-label">Name</label>
									<div class="col-12">
										<input id="text" name="sub_category" class="form-control here slug-title"
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

<script>
	document.getElementById('submit-button').addEventListener('click', function (event) {
		var parentCategory = document.getElementById('parent-category').value;
		if (parentCategory === '') {
			event.preventDefault(); // Prevent form submission
			alert('Please select a category.'); // Display alert message
		}
	});
</script>

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