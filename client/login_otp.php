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
            <div class="col-lg-6 col-md-10">
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
                        <h4 class="text-dark mb-5">Login With OTP</h4>

                        <form method="POST" class="form-horizontal auth-form my-4" action="check_otp.php">
                            <div class="row">
                                <div class="form-group col-md-12 mb-4">
                                    <div class="input-group">
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            placeholder="Enter Phone Number" aria-describedby="button-addon2">
                                        <button type="button" class="btn btn-primary ml-2" id="sendOTP"
                                            style="background-color: #242425">Send OTP</button>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 ">
                                    <input type="tel" class="form-control" id="password" name="otp"
                                        placeholder="Enter OTP">
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex my-2 justify-content-between">
                                        <div class="d-inline-block mr-3">

                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mb-4"
                                        style="background-color: #242425">Sign In</button>
                                    <p class="sign-upp">Don't have an account yet ?
                                        <a class="text-blue" href="register.php">Sign Up</a>
                                    </p>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    (function ($) {
        $(document).ready(function () {
            $('#sendOTP').click(function () {
                // Get the phone number from the form
                var phone = $('#phone').val();
                // Disable the "Send OTP" button
                $('#sendOTP').prop('disabled', true);
                // Send an AJAX request to the server
                $.ajax({
                    type: "POST",
                    url: "send_otp.php",
                    data: { phone: phone },
                    success: function (response) {
                        // Check the response from the PHP code
                        if (response === "present") {
                            // Display success message using SweetAlert
                            Swal.fire({
                                icon: 'success',
                                title: 'OTP sent successfully!',
                                showConfirmButton: true,
                                confirmButtonText: 'Okay',

                            });
                        } else if (response === "not_present") {

                            Swal.fire({
                                icon: 'error',
                                title: 'Account is not registered. Please register first.',
                                showConfirmButton: true,
                                confirmButtonText: 'Okay',

                                willClose: () => {
                                    // Redirect to register.php
                                    window.location.href = "register.php";
                                }
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        // Display error message using SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to send OTP',
                            text: error,
                            confirmButtonText: 'Okay'
                        });
                    }
                });

                // Disable the "Send OTP" button for 30 seconds
                var remainingTime = 30;
                var countdownInterval = setInterval(function () {
                    remainingTime--;
                    if (remainingTime === 0) {
                        clearInterval(countdownInterval);
                        // Enable the "Send OTP" button
                        $('#sendOTP').prop('disabled', false);
                        // Reset the button text
                        $('#sendOTP').text('Send OTP');
                    } else {
                        // Update the button text with remaining time
                        $('#sendOTP').text('Resend in ' + remainingTime + 's');
                    }
                }, 1000);
            });
        });
    })(jQuery);
</script>

</html>