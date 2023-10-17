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
                                        <span>Select Product</span>
                                        <select class="form-select" name="prod_name">
                                            <option value="">Select</option>
                                            <?php foreach ($products as $prod): ?>
                                                <option value="<?php echo $prod['id']; ?>">
                                                    <?php echo $prod['prod_name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    &nbsp;
                                    <div class="col-md-6">
                                        <label class="form-label">Select Form Number</label>
                                        <select name="select-number" id="select-number" class="form-select">
                                            <option value="">Select</option>
                                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                                <option value="<?php echo $i; ?>">
                                                    <?php echo $i; ?>
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    &nbsp;
                                    <div class="col-md-6" id="form-names-section">
                                        <label class="form-label">Select Form Names</label>
                                        <?php for ($i = 1; $i <= 10; $i++): ?>

                                            <select name="categories<?php echo $i; ?>" id="Categories<?php echo $i; ?>"
                                                class="form-select" style="display: none;">

                                                <option value="">Select</option>
                                                <?php foreach ($temp as $template): ?>
                                                    <option value="<?php echo $template['id']; ?>">
                                                        <?php echo $template['template_name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            &nbsp;
                                        <?php endfor; ?>
                                    </div>
                                </div>
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
                    <?php
                    include "footer.php";
                    ?>
                </p>
            </div>
        </footer>
    </div>
</div>

<script>
    document.getElementById('select-number').addEventListener('change', function () {
        var selectedValue = parseInt(this.value);
        var formNamesSection = document.getElementById('form-names-section');

        // Hide all dropdown boxes
        var dropdowns = formNamesSection.getElementsByTagName('select');
        for (var i = 0; i < dropdowns.length; i++) {
            dropdowns[i].style.display = 'none';
        }

        // Show the selected number of dropdown boxes
        for (var i = 1; i <= selectedValue; i++) {
            var dropdown = document.getElementById('Categories' + i);
            if (dropdown) {
                dropdown.style.display = 'block';
            }
        }
    });
</script>


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