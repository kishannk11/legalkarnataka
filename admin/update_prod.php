<?php
require 'navbar.php';
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/config.php';
$id = $_GET['id'];
$mainCategoryObj = new MainCategory($conn);
$categories = $mainCategoryObj->getMainCategories();
$productObj = new Product($conn);
$prodinfo = $productObj->getProductwithId($id);
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
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1> Product Update</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Product Update
                </p>
            </div>
            <div>
                <a href="product-list.html" class="btn btn-primary"> View All
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Product Update</h2>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form class="row g-3" method="POST" action="product-update.php"
                                    enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">Product Name</label>
                                        <input type="text" class="form-control" name="prod_name"
                                            value="<?php echo htmlspecialchars($prodinfo[0]['prod_name'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <input type="hidden" class="form-control" name="prod_id"
                                            value="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Select Categories</label>
                                        <select name="categories" id="Categories" class="form-select">
                                            <?php foreach ($categories as $category): ?>
                                                <optgroup
                                                    label="<?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>">
                                                    <?php
                                                    $subCategoryObj = new SubCategory($conn);
                                                    $subCategories = $subCategoryObj->getSubCategoriesByID($category['id']);
                                                    foreach ($subCategories as $subCategory) {

                                                        echo "<option value=\"{$subCategory['id']}|{$subCategory['parent_category']}\">{$subCategory['name']}</option>";
                                                    }
                                                    ?>
                                                </optgroup>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" class="form-control" name="price"
                                            value="<?php echo htmlspecialchars($prodinfo[0]['price'], ENT_QUOTES, 'UTF-8'); ?>">
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Full Detail</label>
                                <textarea class="form-control" name="details"
                                    rows="4"><?php echo htmlspecialchars($prodinfo[0]['details'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Full Detail</label>
                                <textarea class="form-control" name="additionalfiles"
                                    rows="4"><?php echo htmlspecialchars($prodinfo[0]['additionalfiles'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Images</label>
                                <input type="file" class="form-control" name="images[]" multiple>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
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
<script src="assets/plugins/tags-input/bootstrap-tagsinput.js"></script>
<script src="assets/plugins/simplebar/simplebar.min.js"></script>
<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
<script src="assets/plugins/slick/slick.min.js"></script>

<!-- Option Switcher -->
<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>
<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="assets/pages/jquery.sweet-alert.init.js"></script>

<!-- Ekka Custom -->
<script src="assets/js/ekka.js"></script>
</body>

</html>