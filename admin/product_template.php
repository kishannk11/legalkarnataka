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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('config/config.php');
require('Database.php');
$templates = new Templates($conn);
$temp = $templates->getAllTemplates();

$product = new Product($conn);
$products = $product->getProduct();
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
                        <h2>Add Form for Product</h2>
                    </div>
                    <form class="row g-3" method="POST" action="product_template_save.php">
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <div class="col-md-6">
                                        <select class="form-select" name="prod_name">
                                            <option value="">Select</option>
                                            <?php foreach ($products as $prod): ?>
                                                <option value="<?php echo $prod['id']; ?>"><?php echo $prod['prod_name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    &nbsp;
                                    <div class="col-md-6">
                                        <label class="form-label" for="input-number">Select Number of inputs</label>
                                        <select id="input-number" class="form-select">
                                            <option>Select</option>
                                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    &nbsp;
                                    &nbsp;
                                    <div class="col-md-6" id="form-names-section" style="display: none;">
                                        <label class="form-label" id="input-number">Select Form Names</label>
                                        <?php for ($i = 1; $i <= 10; $i++): ?>
                                            <select name="categories<?php echo $i; ?>" id="Categories<?php echo $i; ?>"
                                                class="form-select">
                                                <option value="">Select</option> <!-- Add a default option -->
                                                <?php foreach ($temp as $template): ?>
                                                    <option value="<?php echo $template['id']; ?>"><?php echo $template['template_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                &nbsp;
                                &nbsp;
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <button name="preview" class="btn btn-primary">Preview</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>

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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var selectedNumber = parseInt(document.getElementById('input-number').value);
        var formNamesSection = document.getElementById('form-names-section');

        if (selectedNumber > 0) {
            formNamesSection.style.display = 'block';
        }

        document.getElementById('input-number').addEventListener('change', function () {
            selectedNumber = parseInt(this.value);

            // Hide all dropdown boxes
            var allDropdowns = document.querySelectorAll('#form-names-section select');
            for (var i = 0; i < allDropdowns.length; i++) {
                allDropdowns[i].style.display = 'none';
            }

            // Show selected number of dropdown boxes
            for (var i = 1; i <= selectedNumber; i++) {
                var dropdown = document.getElementById('Categories' + i);
                dropdown.style.display = 'block';
            }
        });
    });
</script>
<!-- <script>
    document.querySelector('button[name="preview"]').addEventListener('click', function () {
        var selectedIds = [];
        var dropdowns = document.querySelectorAll('select[name="categories"]');

        dropdowns.forEach(function (dropdown) {
            if (dropdown.value !== 'Select') {
                selectedIds.push(dropdown.value);
            }
        });

        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetc_data.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                // Handle the response and display the data in a pop-up box or any other desired format
                console.log(response);
            }
        };
        xhr.send('ids=' + JSON.stringify(selectedIds));
    });

</script> -->
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