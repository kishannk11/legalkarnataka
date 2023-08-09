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
<div class="ec-content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Template</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Template
                </p>
            </div>
            <div>
                <a href="product-list.html" class="btn btn-primary"> Add Template</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Add Template</h2>
                    </div>
                    <form class="row g-3" method="POST" action="template.php">
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Template Name</label>
                                            <input type="text" class="form-control" name="template_name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Template Code</label>
                                            <textarea class="form-control" name="details" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer mt-auto">
            <div class="copyright bg-white">
                <p>
                    Copyright &copy; <span id="ec-year"></span><a class="text-primary"
                        href="https://themeforest.net/user/ashishmaraviya" target="_blank"> Ekka Admin Dashboard</a>.
                    All Rights
                    Reserved.
                </p>
            </div>
        </footer>

    </div> <!-- End Page Wrapper -->
</div>
<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/plugins/simplebar/simplebar.min.js"></script>
<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
<script src="assets/plugins/slick/slick.min.js"></script>

<!-- Datatables -->
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