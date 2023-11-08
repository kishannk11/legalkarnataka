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
if (!isset($_GET['token'])) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Token is missing!",
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

                        <form action="reset.php" method="POST" onsubmit="return checkPasswords()">
                            <div class="row" style="max-width: 300px; margin: auto;">
                                <div class="form-group mb-4 position-relative">
                                    <input type="hidden" name="token"
                                        value="<?php echo htmlspecialchars($_GET['token']); ?>">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password">
                                    <button type="button" onclick="togglePasswordVisibility('password')"
                                        style="position: absolute; top: 50%; right: -35px; transform: translateY(-50%);">👁️</button>
                                </div>
                                <div class="form-group mb-4 position-relative">
                                    <input type="password" class="form-control" id="conpassword" name="conpassword"
                                        placeholder="Confirm Password">
                                    <button type="button" onclick="togglePasswordVisibility('conpassword')"
                                        style="position: absolute; top: 50%; right: -35px; transform: translateY(-50%);">👁️</button>
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
<script>
    function togglePasswordVisibility(id) {
        var x = document.getElementById(id);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<script>
    function checkPasswords() {
        var password = document.getElementById('password').value;
        var conpassword = document.getElementById('conpassword').value;

        if (password != conpassword) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Passwords do not match!",
            });
            return false;
        }

        return true;
    }
</script>

</html>