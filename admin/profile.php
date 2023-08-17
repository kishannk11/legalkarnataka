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
            <div>
                <a href="user-list.html" class="btn btn-primary">Edit</a>
            </div>
        </div>
        <div class="card bg-white profile-content">
            <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <div class="profile-content-left profile-left-spacing">
                        <div class="text-center widget-profile px-0 border-0">
                            <div class="card-img mx-auto rounded-circle">
                                <img src="assets/img/user/u1.jpg" alt="user image">
                            </div>
                            <div class="card-body">
                                <h4 class="py-2 text-dark">Admin</h4>
                                <p>
                                    <?php echo $adminInfo['Name']; ?>
                                </p>
                                <a class="btn btn-primary my-3" href="#">Follow</a>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between ">
                            <div class="text-center pb-4">
                                <h6 class="text-dark pb-2">546</h6>
                                <p>Bought</p>
                            </div>

                            <div class="text-center pb-4">
                                <h6 class="text-dark pb-2">32</h6>
                                <p>Wish List</p>
                            </div>

                            <div class="text-center pb-4">
                                <h6 class="text-dark pb-2">1150</h6>
                                <p>Following</p>
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
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="true">Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="settings-tab" data-bs-toggle="tab"
                                    data-bs-target="#settings" type="button" role="tab" aria-controls="settings"
                                    aria-selected="false">Settings</button>
                            </li>
                        </ul>
                        <div class="tab-content px-3 px-xl-5" id="myTabContent">

                            <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                aria-labelledby="profile-tab">
                                <div class="tab-widget mt-5">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="media widget-media p-3 bg-white border">
                                                <div class="icon rounded-circle mr-3 bg-primary">
                                                    <i class="mdi mdi-account-outline text-white "></i>
                                                </div>

                                                <div class="media-body align-self-center">
                                                    <h4 class="text-primary mb-2">546</h4>
                                                    <p>Bought</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="media widget-media p-3 bg-white border">
                                                <div class="icon rounded-circle bg-warning mr-3">
                                                    <i class="mdi mdi-cart-outline text-white "></i>
                                                </div>

                                                <div class="media-body align-self-center">
                                                    <h4 class="text-primary mb-2">1953</h4>
                                                    <p>Wish List</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="media widget-media p-3 bg-white border">
                                                <div class="icon rounded-circle mr-3 bg-success">
                                                    <i class="mdi mdi-ticket-percent text-white "></i>
                                                </div>

                                                <div class="media-body align-self-center">
                                                    <h4 class="text-primary mb-2">02</h4>
                                                    <p>Voucher</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xl-12">

                                            <!-- Notification Table -->
                                            <div class="card card-default">
                                                <div class="card-header justify-content-between mb-1">
                                                    <h2>Latest Notifications</h2>
                                                    <div>
                                                        <button class="text-black-50 mr-2 font-size-20"><i
                                                                class="mdi mdi-cached"></i></button>
                                                        <div class="dropdown show d-inline-block widget-dropdown">
                                                            <a class="dropdown-toggle icon-burger-mini" href="#"
                                                                role="button" id="dropdown-notification"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false" data-display="static"></a>
                                                            <ul class="dropdown-menu dropdown-menu-right"
                                                                aria-labelledby="dropdown-notification">
                                                                <li class="dropdown-item"><a href="#">Action</a></li>
                                                                <li class="dropdown-item"><a href="#">Another action</a>
                                                                </li>
                                                                <li class="dropdown-item"><a href="#">Something else
                                                                        here</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card-body compact-notifications" data-simplebar
                                                    style="height: 434px;">
                                                    <div class="media pb-3 align-items-center justify-content-between">
                                                        <div
                                                            class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                                            <i class="mdi mdi-cart-outline font-size-20"></i>
                                                        </div>
                                                        <div class="media-body pr-3 ">
                                                            <a class="mt-0 mb-1 font-size-15 text-dark" href="#">New
                                                                Order</a>
                                                            <p>Selena has placed an new order</p>
                                                        </div>
                                                        <span class=" font-size-12 d-inline-block"><i
                                                                class="mdi mdi-clock-outline"></i> 10
                                                            AM</span>
                                                    </div>

                                                    <div class="media py-3 align-items-center justify-content-between">
                                                        <div
                                                            class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
                                                            <i class="mdi mdi-email-outline font-size-20"></i>
                                                        </div>
                                                        <div class="media-body pr-3">
                                                            <a class="mt-0 mb-1 font-size-15 text-dark" href="#">New
                                                                Enquiry</a>
                                                            <p>Phileine has placed an new order</p>
                                                        </div>
                                                        <span class=" font-size-12 d-inline-block"><i
                                                                class="mdi mdi-clock-outline"></i> 9
                                                            AM</span>
                                                    </div>


                                                    <div class="media py-3 align-items-center justify-content-between">
                                                        <div
                                                            class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                                            <i class="mdi mdi-stack-exchange font-size-20"></i>
                                                        </div>
                                                        <div class="media-body pr-3">
                                                            <a class="mt-0 mb-1 font-size-15 text-dark" href="#">Support
                                                                Ticket</a>
                                                            <p>Emma has placed an new order</p>
                                                        </div>
                                                        <span class=" font-size-12 d-inline-block"><i
                                                                class="mdi mdi-clock-outline"></i> 10
                                                            AM</span>
                                                    </div>

                                                    <div class="media py-3 align-items-center justify-content-between">
                                                        <div
                                                            class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                                            <i class="mdi mdi-cart-outline font-size-20"></i>
                                                        </div>
                                                        <div class="media-body pr-3">
                                                            <a class="mt-0 mb-1 font-size-15 text-dark" href="#">New
                                                                order</a>
                                                            <p>Ryan has placed an new order</p>
                                                        </div>
                                                        <span class=" font-size-12 d-inline-block"><i
                                                                class="mdi mdi-clock-outline"></i> 10
                                                            AM</span>
                                                    </div>

                                                    <div class="media py-3 align-items-center justify-content-between">
                                                        <div
                                                            class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-info text-white">
                                                            <i class="mdi mdi-calendar-blank font-size-20"></i>
                                                        </div>
                                                        <div class="media-body pr-3">
                                                            <a class="mt-0 mb-1 font-size-15 text-dark" href="">Comapny
                                                                Meetup</a>
                                                            <p>Phileine has placed an new order</p>
                                                        </div>
                                                        <span class=" font-size-12 d-inline-block"><i
                                                                class="mdi mdi-clock-outline"></i> 10
                                                            AM</span>
                                                    </div>

                                                    <div class="media py-3 align-items-center justify-content-between">
                                                        <div
                                                            class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                                            <i class="mdi mdi-stack-exchange font-size-20"></i>
                                                        </div>
                                                        <div class="media-body pr-3">
                                                            <a class="mt-0 mb-1 font-size-15 text-dark" href="#">Support
                                                                Ticket</a>
                                                            <p>Emma has placed an new order</p>
                                                        </div>
                                                        <span class=" font-size-12 d-inline-block"><i
                                                                class="mdi mdi-clock-outline"></i> 10
                                                            AM</span>
                                                    </div>

                                                    <div class="media py-3 align-items-center justify-content-between">
                                                        <div
                                                            class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
                                                            <i class="mdi mdi-email-outline font-size-20"></i>
                                                        </div>
                                                        <div class="media-body pr-3">
                                                            <a class="mt-0 mb-1 font-size-15 text-dark" href="#">New
                                                                Enquiry</a>
                                                            <p>Phileine has placed an new order</p>
                                                        </div>
                                                        <span class=" font-size-12 d-inline-block"><i
                                                                class="mdi mdi-clock-outline"></i> 9
                                                            AM</span>
                                                    </div>

                                                </div>
                                                <div class="mt-3"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <div class="tab-pane-content mt-5">
                                    <form action="admin-profile.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row mb-6">
                                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">User
                                                Image</label>
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="custom-file mb-1">
                                                    <input type="file" name="image" class="custom-file-input"
                                                        id="coverImage" value="<?php echo $adminInfo['image']; ?>">
                                                    <label class="custom-file-label" for="coverImage">Choose
                                                        file...</label>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="firstName">Name</label>
                                                    <input type="text" class="form-control" name="name" id="firstName"
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
                                            <input type="password" name="confirmpassword" class="form-control"
                                                id="conPassword">
                                        </div>

                                        <div class="d-flex justify-content-end mt-5">
                                            <button type="submit" class="btn btn-primary mb-2 btn-pill">Update
                                                Profile</button>
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

<!-- Option Switcher -->
<script src="assets/plugins/options-sidebar/optionswitcher.js"></script>
<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="assets/pages/jquery.sweet-alert.init.js"></script>

<!-- Ekka Custom -->
<script src="assets/js/ekka.js"></script>

</body>

</html>