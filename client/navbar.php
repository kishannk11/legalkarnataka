<?php
include 'config/session.php';
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
    <meta name="author" content="ashishmaraviya">

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
                                <a href="index.html">
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
                                <form class="ec-btn-group-form" action="#">
                                    <input class="form-control ec-search-bar" placeholder="Search products..."
                                        type="text">
                                    <button class="submit" type="submit"><i class="fi-rr-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <!-- Ec Header Search End -->

                        <!-- Ec Header Button Start -->
                        <div class="align-self-center">
                            <div class="ec-header-bottons">

                                <!-- Header User Start -->
                                <div class="ec-header-user dropdown">
                                    <button class="dropdown-toggle" data-bs-toggle="dropdown"><i
                                            class="fi-rr-user"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>

                                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                    </ul>
                                </div>
                                <!-- Header User End -->
                                <!-- Header wishlist Start -->

                                <!-- Header Cart End -->
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
                            <a href="index.html"><img src="https://legalkarnataka.com/admin/assets/img/logo/legal.png"
                                    alt="Site Logo" /><img class="dark-logo"
                                    src="https://legalkarnataka.com/admin/assets/img/logo/legal.png" alt="Site Logo"
                                    style="display: none;" /></a>
                        </div>
                    </div>

                    <div class="col">
                        <div class="header-search">
                            <form class="ec-btn-group-form" action="#">
                                <input class="form-control ec-search-bar" placeholder="Search products..." type="text">
                                <button class="submit" type="submit"><i class="fi-rr-search"></i></button>
                            </form>
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
                            <a href="javascript:void(0)" class="ec-header-btn ec-sidebar-toggle">
                                <i class="fi fi-rr-apps"></i>
                            </a>
                            <ul>
                                <li><a href="product-left-sidebar.php">Home</a></li>
                                <li><a href="services.php">Services</a></li>
                                <li class="dropdown"><a href="javascript:void(0)">Orders</a>
                                    <ul class="sub-menu">
                                        <li><a href="my-orders.php">My Orders</a></li>
                                        <li><a href="#">Track Orders</a></li>
                                    </ul>
                                <li class="dropdown"><a href="javascript:void(0)">Contact</a>
                                    <ul class="sub-menu">
                                        <li><a href="#">Contact Admin</a></li>

                                    </ul>
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
                        <li><a href="https://www.legalkarnataka.com">Home</a></li>

                        <li><a href="javascript:void(0)">Products</a>
                            <ul class="sub-menu">
                                <li><a href="javascript:void(0)">Product page</a>
                                    <ul class="sub-menu">
                                        <li><a href="#">Product </a></li>
                                        <li><a href="#">Product </a></li>
                                    </ul>
                                </li>


                            </ul>
                        </li>

                        <li><a href="javascript:void(0)">Orders</a>
                            <ul class="sub-menu">
                                <li><a href="my-orders.php">My Orders</a></li>
                                <li><a href="#">Track Orders</a></li>

                            </ul>
                        </li>
                        <li class="dropdown"><a href="javascript:void(0)">Contact</a>
                            <ul class="sub-menu">
                                <li><a href="#">Contact Admin</a></li>


                            </ul>
                        </li>


                    </ul>
                </div>

            </div>
        </div>
        <!-- ekka mobile Menu End -->
    </header>