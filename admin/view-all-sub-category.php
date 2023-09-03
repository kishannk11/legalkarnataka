<?php
require 'navbar.php';
?>
<?php
$page = 'users';
$subpage = 'list';
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
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>Sub Category List</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Sub Category List
                </p>
            </div>
            <div>

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
                                    $categoryObj = new SubCategory($conn);
                                    $subCategory = $categoryObj->getSubCategories();
                                    foreach ($subCategory as $categories) {
                                        echo '<tr>';
                                        //echo '<td><img class="vendor-thumb" src="assets/img/vendor/u1.jpg" alt="user profile" /></td>';
                                        echo '<td>' . $categories['name'] . '</td>';
                                        echo '<td>' . $categories['parent_category'] . '</td>';

                                        echo '<td>';
                                        echo '<div class="btn-group mb-1">';
                                        echo '<button type="button" class="btn btn-outline-success">Info</button>';
                                        echo '<button type="button" class="btn btn-outline-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">';
                                        echo '<span class="sr-only">Info</span>';
                                        echo '</button>';
                                        echo '<div class="dropdown-menu">';
                                        echo '<a class="dropdown-item" href="sub-edit.php?id=' . $categories["id"] . '">Edit</a>';
                                        echo '<a class="dropdown-item" onclick="confirmDelete(' . $categories["id"] . ')">Delete</a>';
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
<script>
    function confirmDelete(Id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace("delete_sub.php?id=" + Id);
            }
        });
    }
</script>
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
<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="assets/pages/jquery.sweet-alert.init.js"></script>

<!-- Ekka Custom -->
<script src="assets/js/ekka.js"></script>
</body>

</html>