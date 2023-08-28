<?php
include 'navbar.php';
?>
<?php
include 'config/config.php';
include '../admin/Database.php';
$id = $_SESSION['id'];
$userObj = new User($conn);
$user = $userObj->getUserInfo($id);
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

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div
                                                    class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">
                                                    <h6>E-mail address <a href="javasript:void(0)"
                                                            data-link-action="editmodal" title="Edit Detail"
                                                            data-bs-toggle="modal" data-bs-target="#edit_modal"><i
                                                                class="fi-rr-edit"></i></a></h6>
                                                    <ul>
                                                        <li><strong>Email : </strong>
                                                            <?php echo $user['email'] ?>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div
                                                    class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">
                                                    <h6>Contact nubmer<a href="javasript:void(0)"
                                                            data-link-action="editmodal" title="Edit Detail"
                                                            data-bs-toggle="modal" data-bs-target="#edit_modal"><i
                                                                class="fi-rr-edit"></i></a></h6>
                                                    <ul>
                                                        <li><strong>Phone Nubmer : </strong>
                                                            <?php echo $user['phonenumber'] ?>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-address mar-b-30">
                                                    <h6>Address<a href="javasript:void(0)" data-link-action="editmodal"
                                                            title="Edit Detail" data-bs-toggle="modal"
                                                            data-bs-target="#edit_modal"><i class="fi-rr-edit"></i></a>
                                                    </h6>
                                                    <ul>
                                                        <li><strong>Home : </strong>Banglore</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-address">
                                                    <h6>Shipping Address<a href="javasript:void(0)"
                                                            data-link-action="editmodal" title="Edit Detail"
                                                            data-bs-toggle="modal" data-bs-target="#edit_modal"><i
                                                                class="fi-rr-edit"></i></a></h6>
                                                    <ul>
                                                        <li><strong>Office : </strong>Banglore</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
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
<?php
include "footer.php";
?>