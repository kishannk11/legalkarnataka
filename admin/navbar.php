<?php
include 'config/session.php';
?>
<?php
include 'config/config.php';
include 'Database.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$admin = new Admin($conn);
$adminInfo = $admin->getAdminInfo();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Legal Karnataka - Admin Dashboard">

	<title>Legal Karnataka - Admin Dashboard </title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap"
		rel="stylesheet">

	<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

	<!-- PLUGINS CSS STYLE -->
	<link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
	<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

	<!-- Ekka CSS -->
	<link id="ekka-css" href="assets/css/ekka.css" rel="stylesheet" />

	<!-- FAVICON -->
	<link href="https://legalkarnataka.com/admin/assets/img/logo/legal.png" rel="shortcut icon" />
	<style>
		.ec-brand-name {
			font-size: 100px;
			/* adjust the font size as needed */
		}
	</style>
	<!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">

	<!--  WRAPPER  -->
	<div class="wrapper">


		<!-- LEFT MAIN SIDEBAR -->
		<div class="ec-left-sidebar ec-bg-sidebar">
			<div id="sidebar" class="sidebar ec-sidebar-footer">

				<div class="ec-brand">
					<a href="index.html" title="Legal Karnataka">
						<img class="ec-brand-icon" src="assets/img/logo/legal.png" alt="" />
						&nbsp;
						&nbsp;
						<h4><span style="color: #BA110C">Legal Karnataka</span></h4>
					</a>
				</div>

				<!-- begin sidebar scrollbar -->
				<div class="ec-navigation" data-simplebar>
					<!-- sidebar menu udate-->

					<ul class="nav sidebar-inner" id="sidebar-menu">
						<!-- Dashboard -->
						<li class="<?php if ($page == 'dashboard')
							echo 'active'; ?>">
							<a class="sidenav-item-link" href="dashboard.php">
								<i class="mdi mdi-view-dashboard-outline"></i>
								<span class="nav-text">Dashboard</span>
							</a>

						</li>

						<!-- Vendors -->


						<!-- Users -->
						<li class="has-sub ">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-account-group"></i>
								<span class="nav-text">Users</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="users" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="user-list.php">
											<span class="nav-text">User List</span>
										</a>
									</li>



								</ul>
							</div>

						</li>

						<!-- Category -->
						<li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-dns-outline"></i>
								<span class="nav-text">Categories</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="categorys" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="main-category.php">
											<span class="nav-text">Main Category</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="view-all-main-category.php">
											<span class="nav-text">View All Main Category</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="sub-category.php">
											<span class="nav-text">Sub Category</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="view-all-sub-category.php">
											<span class="nav-text">View All Sub Category</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

						<!-- Products -->
						<li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-palette-advanced"></i>
								<span class="nav-text">Products</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="products" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="product-add.php">
											<span class="nav-text">Add Product</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="product-list.php">
											<span class="nav-text">List Product</span>
										</a>
									</li>


								</ul>
							</div>
						</li>

						<!-- Orders -->
						<li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-cart"></i>
								<span class="nav-text">Orders</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="new-order.php">
											<span class="nav-text">New Orders</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="shipped-order.php">
											<span class="nav-text">Shipped Orders</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="delivered-order.php">
											<span class="nav-text">Delivered Orders</span>
										</a>
									</li>

								</ul>
							</div>
						</li>
						<li class="has-sub">
							<a class="sidenav-item-link" href="javascript:void(0)">
								<i class="mdi mdi-apps-box"></i>
								<span class="nav-text">Templates</span> <b class="caret"></b>
							</a>
							<div class="collapse">
								<ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
									<li class="">
										<a class="sidenav-item-link" href="create_template.php">
											<span class="nav-text">Add Templates</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="template_list.php">
											<span class="nav-text">Template List</span>
										</a>
									</li>

									<li class="">
										<a class="sidenav-item-link" href="product_template.php">
											<span class="nav-text">Add Templates for Product</span>
										</a>
									</li>
									<li class="">
										<a class="sidenav-item-link" href="product_template_list.php">
											<span class="nav-text">Product Template list</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

					</ul>
				</div>
			</div>
		</div>

		<div class="ec-page-wrapper">

			<!-- Header -->
			<header class="ec-main-header" id="header">
				<nav class="navbar navbar-static-top navbar-expand-lg">
					<!-- Sidebar toggle button -->
					<button id="sidebar-toggler" class="sidebar-toggle"></button>
					<!-- search form -->
					<div class="search-form d-lg-inline-block">
						<div class="input-group">
							<input type="text" name="query" id="search-input" class="form-control"
								placeholder="search.." autofocus autocomplete="off" />
							<button type="button" name="search" id="search-btn" class="btn btn-flat">
								<i class="mdi mdi-magnify"></i>
							</button>
						</div>
						<div id="search-results-container">
							<ul id="search-results"></ul>
						</div>
					</div>

					<!-- navbar right -->
					<div class="navbar-right">
						<ul class="nav navbar-nav">
							<!-- User Account -->
							<li class="dropdown user-menu">
								<button class="dropdown-toggle nav-link ec-drop" data-bs-toggle="dropdown"
									aria-expanded="false">
									<img src="<?php echo $adminInfo['image']; ?>" class="user-image" alt="User Image" />
								</button>
								<ul class="dropdown-menu dropdown-menu-right ec-dropdown-menu">
									<!-- User image -->
									<li class="dropdown-header">
										<img src="<?php echo $adminInfo['image']; ?>" class="img-circle"
											alt="User Image" />
										<div class="d-inline-block">
											<a>
												<i class="mdi mdi-account"></i>
												<?php echo $adminInfo['username']; ?>
											</a>

									</li>
									<li>
										<a href="profile.php">
											<i class="mdi mdi-account"></i> Profile
										</a>
									</li>
									<li>
										<a href="#">
											<i class="mdi mdi-email"></i> Message
										</a>
									</li>

									<li class="dropdown-footer">
										<a href="logout.php"> <i class="mdi mdi-logout"></i> Log Out </a>
									</li>
								</ul>
							</li>





							<li class="right-sidebar-in right-sidebar-2-menu">
								<i class="mdi mdi-settings-outline mdi-spin"></i>
							</li>
						</ul>
					</div>
				</nav>
			</header>