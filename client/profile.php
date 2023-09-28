<?php
include 'navbar.php';
?>
<?php
include 'config/config.php';
$id = $_SESSION['id'];
$userObj = new User($conn);
$user = $userObj->getUserInfo($id);
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
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">User Profile</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="#">Home</a></li>
                            <li class="ec-breadcrumb-item active">Profile</li>
                        </ul>
                        <!-- ec-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
    <div class="shop_page">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">

                </div>
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="ec-vendor-block-profile">
                                        <div class="ec-vendor-block-img space-bottom-30">
                                            <div class="">

                                            </div>
                                            <div class="ec-vendor-block-detail">
                                                <img class="v-img" src="../admin/<?php echo $user['image'] ?>"
                                                    alt="vendor image">
                                                <h5 class="name">
                                                    <?php echo $user['firstname'] . ' ' . $user['lastname'] ?>
                                                </h5>
                                                <p></p>
                                            </div>
                                            <p>Hello <span>
                                                    <?php echo $user['firstname'] . ' ' . $user['lastname'] ?>
                                                </span></p>
                                            <p></p>
                                        </div>
                                        <h5>Account Information</h5>
                                        <form method="POST" action="update-profile.php" enctype=multipart/form-data>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div
                                                        class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">

                                                        <li><strong>First Name : </strong>
                                                            <input type="text" name="firstname" class="form-control"
                                                                value="<?php echo $user['firstname'] ?>">
                                                        </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div
                                                        class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">

                                                        <li><strong>Last Name : </strong>
                                                            <input type="text" name="lastname" class="form-control"
                                                                value="<?php echo $user['lastname'] ?>">
                                                        </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div
                                                        class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">

                                                        <li><strong>Email : </strong>
                                                            <input type="text" name="email" class="form-control"
                                                                value="<?php echo $user['email'] ?>">
                                                        </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div
                                                        class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">

                                                        <li><strong>Phone Nubmer : </strong>
                                                            <input class="form-control" name="phone" type="text"
                                                                value="<?php echo $user['phonenumber'] ?>">
                                                        </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div
                                                        class="ec-vendor-detail-block ec-vendor-block-password mar-b-30">

                                                        <li><strong>Upload Image : </strong><input type="file"
                                                                name="image" class="form-control">
                                                        </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-12">
                                                    <div
                                                        class="ec-vendor-detail-block ec-vendor-block-password mar-b-30">

                                                        <li><strong>Password : </strong><input type="password"
                                                                name="password" class="form-control">
                                                        </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div
                                                        class="ec-vendor-detail-block ec-vendor-block-password mar-b-30">

                                                        <li><strong>Confirm Password : </strong><input type="password"
                                                                name="conpassword" class="form-control"></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    &nbsp;
                                                    &nbsp;
                                                    &nbsp;
                                                    <div class="col-md-12 col-sm-12">
                                                        <div
                                                            class="ec-vendor-detail-block ec-vendor-block-password mar-b-30">
                                                            <button type="submit"
                                                                class="btn btn-primary">Submit</button>
                                                        </div>
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
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include "footer.php";
?>