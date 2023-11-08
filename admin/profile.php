<?php
require 'navbar.php';
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$admin = new Admin($conn);
$adminInfo = $admin->getAdminInfo();
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
                <h1>User Profile</h1>
                <p class="breadcrumbs"><span><a href="index.html">Home</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>Profile
                </p>
            </div>

        </div>
        <div class="card bg-white profile-content">
            <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <div class="profile-content-left profile-left-spacing">
                        <div class="text-center widget-profile px-0 border-0">
                            <div class="card-img mx-auto rounded-circle">
                                <img src="<?php echo $adminInfo['image']; ?>" alt="user image">
                            </div>
                            <div class="card-body">
                                <h4 class="py-2 text-dark">Admin</h4>
                                <p>
                                    <?php echo $adminInfo['Name']; ?>
                                </p>
                                <a class="btn btn-primary my-3" href="#">Follow</a>
                            </div>
                        </div>



                        <hr class="w-100">

                        <div class="contact-info pt-4">
                            <h5 class="text-dark">Contact Information</h5>
                            <p class="text-dark font-weight-medium pt-24px mb-2">Email address</p>
                            <p>
                                <?php echo $adminInfo['email']; ?>
                            </p>


                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-xl-9">
                    <div class="profile-content-right profile-right-spacing py-5">
                        <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="settings-tab" data-bs-toggle="tab"
                                    data-bs-target="#settings" type="button" role="tab" aria-controls="settings"
                                    aria-selected="false">Settings</button>
                            </li>
                        </ul>
                        <div class="tab-content px-3 px-xl-5" id="myTabContent">

                            <div class="tab-pane fade show active" id="settings" role="tabpanel"
                                aria-labelledby="profile-tab">
                                <div class="tab-widget mt-5">
                                    <div class="row">
                                        <div class="card card-default">
                                            <div class="tab-pane-content mt-5">
                                                <form action="admin-profile.php" method="POST"
                                                    enctype="multipart/form-data">
                                                    <div class="form-group row mb-6">
                                                        <label for="coverImage"
                                                            class="col-sm-4 col-lg-2 col-form-label">User
                                                            Image</label>
                                                        <div class="col-sm-8 col-lg-10">
                                                            <div class="custom-file mb-1">
                                                                <input type="file" name="image"
                                                                    class="custom-file-input" id="coverImage"
                                                                    value="<?php echo $adminInfo['image']; ?>">
                                                                <label class="custom-file-label" for="coverImage">Choose
                                                                    file...</label>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="firstName">Name</label>
                                                                <input type="text" class="form-control" name="name"
                                                                    id="firstName"
                                                                    value="<?php echo $adminInfo['Name']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="form-group mb-4">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" id="email"
                                                            value="<?php echo $adminInfo['email']; ?>">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="newPassword">New password</label>
                                                        <input type="password" name="password" class="form-control"
                                                            id="newPassword">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="conPassword">Confirm password</label>
                                                        <input type="password" name="confirmpassword"
                                                            class="form-control" id="conPassword">
                                                    </div>

                                                    <div class="d-flex justify-content-end mt-5">
                                                        <button type="submit"
                                                            class="btn btn-primary mb-2 btn-pill">Update
                                                            Profile</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                    </div>


                                </div>
                            </div>

                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">

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
            <?php include 'footer.php'; ?>
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

<!-- Option Switcher -->
<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>
<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="assets/pages/jquery.sweet-alert.init.js"></script>

<!-- Ekka Custom -->
<script src="assets/js/ekka.js"></script>

</body>

</html>