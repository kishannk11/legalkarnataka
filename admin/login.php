<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'config/config.php';
require_once "Database.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$user = new admin($conn);
	$user->username = $_POST["username"];
	$user->password = $_POST["userpassword"];
	if ($user->login()) {
		header("location: dashboard.php");
		exit;
	} else {
		$error = "Invalid username or password.";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Ekka - Admin Dashboard HTML Template.">

	<title>Legal Karnataka - Admin login</title>

	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap"
		rel="stylesheet">

	<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

	<!-- Ekka CSS -->
	<link id="ekka-css" rel="stylesheet" href="assets/css/ekka.css" />

	<!-- FAVICON -->
	<link href="assets/img/favicon.png" rel="shortcut icon" />
	<style>
		.ec-brand {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 10vh;
			/* adjust the height as needed */
		}

		.rounded-image {
			width: 100px;
			/* adjust the size as needed */
			height: 100px;
			border-radius: 80%;
			overflow: hidden;
		}
	</style>
</head>

<body class="sign-inup" id="body">
	<div class="container d-flex align-items-center justify-content-center form-height-login pt-24px pb-24px">
		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-10">
				<div class="card">
					<div class="card-header" style="background-color: #242425">

						<div class="ec-brand">
							<div class="rounded-image">
								<a href="#" title="Legal Karnataka">
									<img src="assets/img/logo/legal-logo.png" alt="">
								</a>
							</div>
						</div>

					</div>
					<div class="card-body p-5">
						<?php
						if (isset($error)) {
							echo '<div class="alert alert-danger">' . $error . '</div>';
						}
						?>
						<h4 class="text-dark mb-5">Sign In</h4>

						<form method="POST" class="form-horizontal auth-form my-4" action="login.php">
							<div class="row">
								<div class="form-group col-md-12 mb-4">
									<input type="text" class="form-control" id="email" name="username"
										placeholder="Username">
								</div>

								<div class="form-group col-md-12 ">
									<input type="password" class="form-control" id="password" name="userpassword"
										placeholder="Password">
								</div>

								<div class="col-md-12">
									<div class="d-flex my-2 justify-content-between">
										<div class="d-inline-block mr-3">
											<div class="control control-checkbox">Remember me
												<input type="checkbox" />
												<div class="control-indicator"></div>
											</div>
										</div>

										<p><a class="text-blue" href="#">Forgot Password?</a></p>
									</div>

									<button type="submit" class="btn btn-primary btn-block mb-4"
										style="background-color: #242425">Sign In</button>

									<p class="sign-upp">Don't have an account yet ?
										<a class="text-blue" href="sign-up.html">Sign Up</a>
									</p>
									<!-- <button type="submit" class="btn btn-primary btn-block mb-4" style="background-color: #242425">Sign In</button> -->
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Javascript -->
	<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
	<script src="assets/plugins/slick/slick.min.js"></script>

	<!-- Ekka Custom -->
	<script src="assets/js/ekka.js"></script>
</body>

</html>