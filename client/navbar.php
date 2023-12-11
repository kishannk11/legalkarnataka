<?php
include 'config/session.php';
include 'ordergen.php';
?>
<?php
include 'config/config.php';
include '../admin/Database.php';
$userObj = new User($conn);
$user = $userObj->getUserInfo($_SESSION['id']);
?>
<?php
$cartObj = new Cart($conn);
$email = $_SESSION['email'];
$cartCount = $cartObj->getCartItemCount($email);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Legal Karnataka.</title>
    <meta name="keywords"
        content="apparel, catalog, clean, ecommerce, ecommerce HTML, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops" />
    <meta name="description" content="Best ecommerce html template for single and multi vendor store.">


    <!-- site Favicon -->
    <link rel="icon" href="https://legalkarnataka.com/admin/assets/img/logo/legal.png" sizes="32x32" />
    <link rel="apple-touch-icon" href="https://legalkarnataka.com/admin/assets/img/logo/legal.png" />
    <meta name="msapplication-TileImage" content="https://legalkarnataka.com/admin/assets/img/logo/legal.png" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- css Icon Font -->
    <link rel="stylesheet" href="assets/css/vendor/ecicons.min.css" />

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css" />
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/countdownTimer.css" />
    <link rel="stylesheet" href="assets/css/plugins/slick.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.css" />

    <!-- Main Style -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

    <!-- PLUGINS CSS STYLE -->

    <!-- Background css -->
    <link rel="stylesheet" id="bg-switcher-css" href="assets/css/backgrounds/bg-4.css">
    <style>
        .ec-single-cart button {
            display: inline-block;
            margin-right: 10px;
        }

        .button-group {
            display: flex;
            gap: 10px;
        }
    </style>
    <style>
        .scrollable-div {
            height: 200px;
            /* Adjust the height as per your requirement */
            overflow-y: auto;
        }
    </style>
    <style>
        .search-container {
            position: relative;
        }

        #results {
            display: none;
            /* Add this line */
            position: absolute;
            width: 100%;
            z-index: 1;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            /* Add shadow for 3D effect */
            padding: 12px 16px;
            /* Add padding */
            font-size: 16px;
            /* Change font size */
            border-radius: 5px;
            /* Round the corners */
        }

        #results p {
            margin: 0;
            /* Remove default paragraph margins */
        }

        #results a {
            text-decoration: none;
            /* Remove underline from links */
            color: black;
            /* Change link color */
        }

        #results a:hover {
            color: blue;
            /* Change link color on hover */
        }
    </style>
    <style>
        .product-name {
            word-wrap: break-word;
            display: inline-block;
            /* This is needed to make sure the width is not infinite */
            width: 100%;
            /* Adjust this value according to your needs */
        }
    </style>

</head>

<body class="product_page">
    <div id="ec-overlay">
        <div class="ec-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Header start  -->
    <header class="ec-header">
        <div class="col d-lg-none ">
            <div class="ec-header-bottons">
                <!-- Header User Start -->
                <div class="ec-header-user dropdown">
                    <button class="dropdown-toggle" data-bs-toggle="dropdown"><i class="fi-rr-user"></i></button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>

                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
                <!-- Header Cart End -->
                <!-- Header menu Start -->
                <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
                    <i class="fi fi-rr-menu-burger"></i>
                </a>
                <!-- Header menu End -->
            </div>
        </div>
        <!--Ec Header Top Start -->
        <!-- Ec Header Top  End -->
        <!-- Ec Header Bottom  Start -->
        <div class="ec-header-bottom d-none d-lg-block">
            <div class="container position-relative">
                <div class="row">
                    <div class="ec-flex">
                        <!-- Ec Header Logo Start -->
                        <div class="align-self-center">
                            <div class="header-logo">
                                <a href="#">
                                    <img src="https://legalkarnataka.com/admin/assets/img/logo/legal.png"
                                        alt="Site Logo" style="width: 70px; height: auto; display: inline-block;" />
                                    <span
                                        style="display: inline-block; vertical-align: middle; font-weight: bold; font-size:40px; larger;">Legal
                                        Karnataka</span>
                                </a>
                            </div>
                        </div>
                        <!-- Ec Header Logo End -->

                        <!-- Ec Header Search Start -->
                        <div class="align-self-center">

                            <div class="header-search">
                                <div class="search-container">
                                    <form id="searchForm" class="ec-btn-group-form" action="#">
                                        <input id="search" class="form-control ec-search-bar"
                                            placeholder="Search products..." type="text">
                                        <button class="submit" type="submit"><i class="fi-rr-search"></i></button>
                                    </form>
                                    <div id="results"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Ec Header Search End -->

                        <!-- Ec Header Button Start -->
                        <div class="align-self-center">
                            <div class="ec-header-bottons">

                                <!-- Header User Start -->
                                <div class="ec-header-user dropdown">
                                    <div class="text-center">
                                        <button class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class="fi-rr-user"></i>

                                        </button>
                                    </div>
                                    <span>
                                        <b>

                                            <?php echo $user['firstname']; ?>

                                        </b>
                                    </span>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ec Header Button End -->
        <!-- Header responsive Bottom  Start -->
        <div class="ec-header-bottom d-lg-none">
            <div class="container position-relative">
                <div class="row ">

                    <!-- Ec Header Logo Start -->
                    <div class="col">
                        <div class="header-logo">
                            <a href="#"><img src="https://legalkarnataka.com/admin/assets/img/logo/legal.png"
                                    alt="Site Logo" /><img class="dark-logo"
                                    src="https://legalkarnataka.com/admin/assets/img/logo/legal.png" alt="Site Logo"
                                    style="display: none;" /></a>
                        </div>
                    </div>

                    <div class="col">
                        <div class="header-search">
                            <div class="search-container">
                                <form id="mobileSearchForm" class="ec-btn-group-form" action="#">
                                    <input id="mobileSearch" class="form-control ec-search-bar"
                                        placeholder="Search products..." type="text">
                                    <button class="submit" type="submit"><i class="fi-rr-search"></i></button>
                                </form>
                                <div id="mobileResults"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Ec Header Search End -->
                </div>
            </div>
        </div>
        <!-- Header responsive Bottom  End -->
        <!-- EC Main Menu Start -->
        <div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-md-12 align-self-center">
                        <div class="ec-main-menu">

                            <ul>
                                <li><a href="product-left-sidebar.php">Home</a></li>
                                <li><a href="services.php">Services</a></li>
                                <li class="dropdown"><a href="javascript:void(0)">Orders</a>
                                    <ul class="sub-menu">
                                        <li><a href="my-orders.php">My Orders</a></li>

                                    </ul>
                                <li class="dropdown"><a href="javascript:void(0)">Contact</a>
                                    <ul class="sub-menu">
                                        <li><a href="https://wa.me/8884449627">Contact Admin</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="cart.php">Cart
                                        <sup>
                                            <span style="color: red;">
                                                <?php echo $cartCount; ?>
                                            </span>
                                        </sup>
                                    </a>
                                </li>

                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ec Main Menu End -->
        <!-- ekka Mobile Menu Start -->
        <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
            <div class="ec-menu-title">
                <span class="menu_title">My Menu</span>
                <button class="ec-close">×</button>
            </div>
            <div class="ec-menu-inner">
                <div class="ec-menu-content">
                    <ul>
                        <li><a href="product-left-sidebar.php">Home</a></li>

                        <li><a href="services.php">Services</a>

                        </li>

                        <li><a href="javascript:void(0)">Orders</a>
                            <ul class="sub-menu">
                                <li><a href="my-orders.php">My Orders</a></li>
                            </ul>
                        </li>
                        <li><a href="cart.php">cart<sup>
                                    <span style="color: red;">
                                        <?php echo $cartCount; ?>
                                    </span>
                                </sup></a>

                        </li>
                        <li class="dropdown"><a href="javascript:void(0)">Contact</a>
                            <ul class="sub-menu">
                                <li><a href="https://wa.me/8884449627">Contact Admin</a></li>
                            </ul>
                        </li>
                        <li><a href="logout.php">Logout</a>

                        </li>


                    </ul>
                </div>

            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#search').on('input', function () {
                    var searchQuery = $(this).val();
                    if (searchQuery !== "") {
                        $.ajax({
                            url: 'search.php',
                            method: 'POST',
                            data: { query: encodeURIComponent(searchQuery) }, // Encode user input
                            success: function (data) {
                                if (data) {
                                    $('#results').html(data).show(); // Show results if there is data
                                } else {
                                    $('#results').hide(); // Hide results if there is no data
                                }
                            }
                        });
                    } else {
                        $('#results').html("").hide(); // Hide results and clear any existing results
                    }
                });

                // Prevent form submission
                $('#searchForm').on('submit', function (e) {
                    e.preventDefault();
                });
            });
        </script>
        <script>
            $(document).ready(function () {

                // Mobile search
                $('#mobileSearch').on('input', function () {
                    var searchQuery = $(this).val();
                    if (searchQuery !== "") {
                        $.ajax({
                            url: 'search.php',
                            method: 'POST',
                            data: { query: encodeURIComponent(searchQuery) }, // Encode user input
                            success: function (data) {
                                if (data) {
                                    $('#mobileResults').html(data).show(); // Show results if there is data
                                } else {
                                    $('#mobileResults').hide(); // Hide results if there is no data
                                }
                            }
                        });
                    } else {
                        $('#mobileResults').html("").hide(); // Hide results and clear any existing results
                    }
                });
                $('#mobileSearchForm').on('submit', function (e) {
                    e.preventDefault();
                });
            });
        </script>
    </header>