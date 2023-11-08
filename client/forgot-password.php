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
    <link id="ekka-css" rel="stylesheet" href="../admin/assets/css/ekka.css" />
    <link href="assets/js/plugins/sweetalert2.min.css" rel="stylesheet" type="text/css">

    <!-- FAVICON -->
    <link href="../admin/assets/img/logo/legal.png" rel="shortcut icon" />
    <style>
        .ec-brand {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 15vh;
            /* adjust the height as needed */
        }

        .rounded-image {
            width: 100px;
            /* adjust the size as needed */
            height: 100px;
            border-radius: 100%;

        }
    </style>
</head>
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

<body class="sign-inup" id="body">
    <div class="container d-flex align-items-center justify-content-center form-height-login pt-30px pb-24px">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #242425">

                        <div class="ec-brand">
                            <div class="rounded-image">
                                <a href="#" title="Legal Karnataka">
                                    <img class="ec-brand-icon" src="assets/images/logo/legal-logo.png" alt="">
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body p-5">
                        <h4 class="text-dark mb-5">Forgot Password?</h4>

                        <form action="send-reset-link.php" method="POST">
                            <div class="row">
                                <div class="form-group col-md-12 mb-4">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block mb-4"
                                        style="background-color: #242425; white-space: nowrap;">Reset Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="assets/js/plugins/sweetalert2.min.js"></script>
<script src="assets/js/plugins/jquery.sweet-alert.init.js"></script>

</html>