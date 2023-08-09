<?php
include('navbar.php');
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
<!-- Header End  -->

<!-- ekka Cart Start -->
<div class="ec-side-cart-overlay"></div>
<div id="ec-side-cart" class="ec-side-cart">
    <div class="ec-cart-inner">
        <div class="ec-cart-top">
            <div class="ec-cart-title">
                <span class="cart_title">My Cart</span>
                <button class="ec-close">×</button>
            </div>
            <ul class="eccart-pro-items">
                <li>
                    <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                            src="assets/images/product-image/6_1.jpg" alt="product"></a>
                    <div class="ec-pro-content">
                        <a href="product-left-sidebar.html" class="cart_pro_title">T-shirt For Women</a>
                        <span class="cart-price"><span>$76.00</span> x 1</span>
                        <div class="qty-plus-minus">
                            <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                        </div>
                        <a href="javascript:void(0)" class="remove">×</a>
                    </div>
                </li>
                <li>
                    <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                            src="assets/images/product-image/12_1.jpg" alt="product"></a>
                    <div class="ec-pro-content">
                        <a href="product-left-sidebar.html" class="cart_pro_title">Women Leather Shoes</a>
                        <span class="cart-price"><span>$64.00</span> x 1</span>
                        <div class="qty-plus-minus">
                            <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                        </div>
                        <a href="javascript:void(0)" class="remove">×</a>
                    </div>
                </li>
                <li>
                    <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                            src="assets/images/product-image/3_1.jpg" alt="product"></a>
                    <div class="ec-pro-content">
                        <a href="product-left-sidebar.html" class="cart_pro_title">Girls Nylon Purse</a>
                        <span class="cart-price"><span>$59.00</span> x 1</span>
                        <div class="qty-plus-minus">
                            <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                        </div>
                        <a href="javascript:void(0)" class="remove">×</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="ec-cart-bottom">
            <div class="cart-sub-total">
                <table class="table cart-table">
                    <tbody>
                        <tr>
                            <td class="text-left">Sub-Total :</td>
                            <td class="text-right">$300.00</td>
                        </tr>
                        <tr>
                            <td class="text-left">VAT (20%) :</td>
                            <td class="text-right">$60.00</td>
                        </tr>
                        <tr>
                            <td class="text-left">Total :</td>
                            <td class="text-right primary-color">$360.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="cart_btn">
                <a href="cart.html" class="btn btn-primary">View Cart</a>
                <a href="checkout.html" class="btn btn-secondary">Checkout</a>
            </div>
        </div>
    </div>
</div>
<!-- ekka Cart End -->

<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">Register</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="ec-breadcrumb-item active">Register</li>
                        </ul>
                        <!-- ec-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ec breadcrumb end -->

<!-- Start Register -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Register</h2>
                    <h2 class="ec-title">Register</h2>
                    <p class="sub-title mb-3"></p>
                </div>
            </div>
            <div class="ec-register-wrapper">
                <div class="ec-register-container">
                    <div class="ec-register-form">
                        <form action="user_resgiter.php" method="POST">
                            <span class="ec-register-wrap ec-register-half">
                                <label>First Name*</label>
                                <input type="text" name="firstname" placeholder="Enter your first name" required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Last Name*</label>
                                <input type="text" name="lastname" placeholder="Enter your last name" required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Email*</label>
                                <input type="email" name="email" placeholder="Enter your email add..." required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Phone Number*</label>
                                <input type="text" name="phonenumber" placeholder="Enter your phone number" required />
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Password*</label>
                                <div class="password-field">
                                    <input type="password" name="password" id="password" placeholder="Enter password"
                                        required />
                                    <button type="button" id="togglePassword" class="toggle-password">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </span>
                            <span class="ec-register-wrap ec-register-half">
                                <label>Confirm Password*</label>
                                <div class="password-field">
                                    <input type="password" name="confirmpassword" id="confirmpassword"
                                        placeholder="Enter password" required />
                                    <button type="button" id="toggleConfirmPassword" class="toggle-password">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </span>


                            <span class="ec-register-wrap ec-register-btn">
                                <button class="btn btn-primary" type="submit">Register</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Register -->

<!-- Footer Start -->
<footer class="ec-footer section-space-mt">
    <div class="footer-container">
        <div class="footer-offer">
            <div class="container">
                <div class="row">
                    <div class="text-center footer-off-msg">
                        <span>Win a contest! Get this limited-editon</span><a href="#" target="_blank">View
                            Detail</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-top section-space-footer-p">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-3 ec-footer-contact">
                        <div class="ec-footer-widget">
                            <div class="ec-footer-logo"><a href="#"><img src="assets/images/logo/footer-logo.png"
                                        alt=""><img class="dark-footer-logo" src="assets/images/logo/dark-logo.png"
                                        alt="Site Logo" style="display: none;" /></a></div>
                            <h4 class="ec-footer-heading">Contact us</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link">71 Pilgrim Avenue Chevy Chase, east california.</li>
                                    <li class="ec-footer-link"><span>Call Us:</span><a href="tel:+440123456789">+44
                                            0123 456 789</a></li>
                                    <li class="ec-footer-link"><span>Email:</span><a
                                            href="mailto:example@ec-email.com">+example@ec-email.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2 ec-footer-info">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Information</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="about-us.html">About us</a></li>
                                    <li class="ec-footer-link"><a href="faq.html">FAQ</a></li>
                                    <li class="ec-footer-link"><a href="#">Delivery Information</a></li>
                                    <li class="ec-footer-link"><a href="contact-us.html">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2 ec-footer-account">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Account</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="#">My Account</a></li>
                                    <li class="ec-footer-link"><a href="track-order.html">Order History</a></li>
                                    <li class="ec-footer-link"><a href="#">Wish List</a></li>
                                    <li class="ec-footer-link"><a href="#">Specials</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2 ec-footer-service">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Services</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="#">Discount Returns</a></li>
                                    <li class="ec-footer-link"><a href="#">Policy & policy </a></li>
                                    <li class="ec-footer-link"><a href="#">Customer Service</a></li>
                                    <li class="ec-footer-link"><a href="terms-condition.html">Term & condition</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 ec-footer-news">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Newsletter</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link">Get instant updates about our new products and
                                        special promos!</li>
                                </ul>
                                <div class="ec-subscribe-form">
                                    <form id="ec-newsletter-form" name="ec-newsletter-form" method="post" action="#">
                                        <div id="ec_news_signup" class="ec-form">
                                            <input class="ec-email" type="email" required=""
                                                placeholder="Enter your email here..." name="ec-email" value="" />
                                            <button id="ec-news-btn" class="button btn-primary" type="submit"
                                                name="subscribe" value=""><i class="ecicon eci-paper-plane-o"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Footer social Start -->
                    <div class="col text-left footer-bottom-left">
                        <div class="footer-bottom-social">
                            <span class="social-text text-upper">Follow us on:</span>
                            <ul class="mb-0">
                                <li class="list-inline-item"><a class="hdr-facebook" href="#"><i
                                            class="ecicon eci-facebook"></i></a></li>
                                <li class="list-inline-item"><a class="hdr-twitter" href="#"><i
                                            class="ecicon eci-twitter"></i></a></li>
                                <li class="list-inline-item"><a class="hdr-instagram" href="#"><i
                                            class="ecicon eci-instagram"></i></a></li>
                                <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i
                                            class="ecicon eci-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer social End -->
                    <!-- Footer Copyright Start -->
                    <div class="col text-center footer-copy">
                        <div class="footer-bottom-copy ">
                            <div class="ec-copy">Copyright © 2023 <a class="site-name text-upper"
                                    href="#">ekka<span>.</span></a>. All Rights Reserved</div>
                        </div>
                    </div>
                    <!-- Footer Copyright End -->
                    <!-- Footer payment -->
                    <div class="col footer-bottom-right">
                        <div class="footer-bottom-payment d-flex justify-content-end">
                            <div class="payment-link">
                                <img src="assets/images/icons/payment.png" alt="">
                            </div>

                        </div>
                    </div>
                    <!-- Footer payment -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->

<!-- Footer navigation panel for responsive display -->
<div class="ec-nav-toolbar">
    <div class="container">
        <div class="ec-nav-panel">
            <div class="ec-nav-panel-icons">
                <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><i
                        class="fi-rr-menu-burger"></i></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><i
                        class="fi-rr-shopping-bag"></i><span
                        class="ec-cart-noti ec-header-count cart-count-lable">3</span></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="index.html" class="ec-header-btn"><i class="fi-rr-home"></i></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="wishlist.html" class="ec-header-btn"><i class="fi-rr-heart"></i><span
                        class="ec-cart-noti">4</span></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="login.html" class="ec-header-btn"><i class="fi-rr-user"></i></a>
            </div>

        </div>
    </div>
</div>
<!-- Footer navigation panel for responsive display end -->

<!-- Recent Purchase Popup  -->
<div class="recent-purchase">
    <img src="assets/images/product-image/1.jpg" alt="payment image">
    <div class="detail">
        <p>Someone in new just bought</p>
        <h6>stylish baby shoes</h6>
        <p>10 Minutes ago</p>
    </div>
    <a href="javascript:void(0)" class="icon-btn recent-close">×</a>
</div>
<!-- Recent Purchase Popup end -->

<!-- Cart Floating Button -->
<div class="ec-cart-float">
    <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
        <div class="header-icon"><i class="fi-rr-shopping-basket"></i>
        </div>
        <span class="ec-cart-count cart-count-lable">3</span>
    </a>
</div>
<!-- Cart Floating Button end -->

<!-- Whatsapp -->
<div class="ec-style ec-right-bottom">
    <!-- Start Floating Panel Container -->
    <div class="ec-panel">
        <!-- Panel Header -->
        <div class="ec-header">
            <strong>Need Help?</strong>
            <p>Chat with us on WhatsApp</p>
        </div>
        <!-- Panel Content -->
        <div class="ec-body">
            <ul>
                <!-- Start Single Contact List -->
                <li>
                    <a class="ec-list" data-number="918866774266"
                        data-message="Please help me! I have got wrong product - ORDER ID is : #654321485">
                        <div class="d-flex bd-highlight">
                            <!-- Profile Picture -->
                            <div class="ec-img-cont">
                                <img src="assets/images/whatsapp/profile_01.jpg" class="ec-user-img"
                                    alt="Profile image">
                                <span class="ec-status-icon"></span>
                            </div>
                            <!-- Display Name & Last Seen -->
                            <div class="ec-user-info">
                                <span>Sahar Darya</span>
                                <p>Sahar left 7 mins ago</p>
                            </div>
                            <!-- Chat iCon -->
                            <div class="ec-chat-icon">
                                <i class="fa fa-whatsapp"></i>
                            </div>
                        </div>
                    </a>
                </li>
                <!--/ End Single Contact List -->
                <!-- Start Single Contact List -->
                <li>
                    <a class="ec-list" data-number="918866774266"
                        data-message="Please help me! I have got wrong product - ORDER ID is : #654321485">
                        <div class="d-flex bd-highlight">
                            <!-- Profile Picture -->
                            <div class="ec-img-cont">
                                <img src="assets/images/whatsapp/profile_02.jpg" class="ec-user-img"
                                    alt="Profile image">
                                <span class="ec-status-icon ec-online"></span>
                            </div>
                            <!-- Display Name & Last Seen -->
                            <div class="ec-user-info">
                                <span>Yolduz Rafi</span>
                                <p>Yolduz is online</p>
                            </div>
                            <!-- Chat iCon -->
                            <div class="ec-chat-icon">
                                <i class="fa fa-whatsapp"></i>
                            </div>
                        </div>
                    </a>
                </li>
                <!--/ End Single Contact List -->
                <!-- Start Single Contact List -->
                <li>
                    <a class="ec-list" data-number="918866774266"
                        data-message="Please help me! I have got wrong product - ORDER ID is : #654321485">
                        <div class="d-flex bd-highlight">
                            <!-- Profile Picture -->
                            <div class="ec-img-cont">
                                <img src="assets/images/whatsapp/profile_03.jpg" class="ec-user-img"
                                    alt="Profile image">
                                <span class="ec-status-icon ec-offline"></span>
                            </div>
                            <!-- Display Name & Last Seen -->
                            <div class="ec-user-info">
                                <span>Nargis Hawa</span>
                                <p>Nargis left 30 mins ago</p>
                            </div>
                            <!-- Chat iCon -->
                            <div class="ec-chat-icon">
                                <i class="fa fa-whatsapp"></i>
                            </div>
                        </div>
                    </a>
                </li>
                <!--/ End Single Contact List -->
                <!-- Start Single Contact List -->
                <li>
                    <a class="ec-list" data-number="918866774266"
                        data-message="Please help me! I have got wrong product - ORDER ID is : #654321485">
                        <div class="d-flex bd-highlight">
                            <!-- Profile Picture -->
                            <div class="ec-img-cont">
                                <img src="assets/images/whatsapp/profile_04.jpg" class="ec-user-img"
                                    alt="Profile image">
                                <span class="ec-status-icon ec-offline"></span>
                            </div>
                            <!-- Display Name & Last Seen -->
                            <div class="ec-user-info">
                                <span>Khadija Mehr</span>
                                <p>Khadija left 50 mins ago</p>
                            </div>
                            <!-- Chat iCon -->
                            <div class="ec-chat-icon">
                                <i class="fa fa-whatsapp"></i>
                            </div>
                        </div>
                    </a>
                </li>
                <!--/ End Single Contact List -->
            </ul>
        </div>
    </div>
    <!--/ End Floating Panel Container -->
    <!-- Start Right Floating Button-->
    <div class="ec-right-bottom">
        <div class="ec-box">
            <div class="ec-button rotateBackward">
                <img class="whatsapp" src="assets/images/common/whatsapp.png" alt="whatsapp icon" />
            </div>
        </div>
    </div>
    <!--/ End Right Floating Button-->
</div>
<!-- Whatsapp end -->

<!-- Feature tools -->
<div class="ec-tools-sidebar-overlay"></div>
<div class="ec-tools-sidebar">
    <div class="tool-title">
        <h3>Features</h3>
    </div>
    <a href="#" class="ec-tools-sidebar-toggle in-out">
        <img alt="icon" src="assets/images/common/settings.png" />
    </a>
    <div class="ec-tools-detail">
        <div class="ec-tools-sidebar-content ec-change-color ec-color-desc">
            <h3>Color Scheme</h3>
            <ul class="bg-panel">
                <li class="active" data-color="01"><a href="#" class="colorcode1"></a></li>
                <li data-color="02"><a href="#" class="colorcode2"></a></li>
                <li data-color="03"><a href="#" class="colorcode3"></a></li>
                <li data-color="04"><a href="#" class="colorcode4"></a></li>
                <li data-color="05"><a href="#" class="colorcode5"></a></li>
            </ul>
        </div>
        <div class="ec-tools-sidebar-content">
            <h3>Backgrounds</h3>
            <ul class="bg-panel">
                <li class="bg"><a class="back-bg-1" id="bg-1">Background-1</a></li>
                <li class="bg"><a class="back-bg-2" id="bg-2">Background-2</a></li>
                <li class="bg"><a class="back-bg-3" id="bg-3">Background-3</a></li>
                <li class="bg"><a class="back-bg-4" id="bg-4">Default</a></li>
            </ul>
        </div>
        <div class="ec-tools-sidebar-content">
            <h3>Full Screen mode</h3>
            <div class="ec-fullscreen-mode">
                <div class="ec-fullscreen-switch">
                    <div class="ec-fullscreen-btn">Mode</div>
                    <div class="ec-fullscreen-on">On</div>
                    <div class="ec-fullscreen-off">Off</div>
                </div>
            </div>
        </div>
        <div class="ec-tools-sidebar-content">
            <h3>Dark mode</h3>
            <div class="ec-change-mode">
                <div class="ec-mode-switch">
                    <div class="ec-mode-btn">Mode</div>
                    <div class="ec-mode-on">On</div>
                    <div class="ec-mode-off">Off</div>
                </div>
            </div>
        </div>
        <div class="ec-tools-sidebar-content">
            <h3>RTL mode</h3>
            <div class="ec-change-rtl">
                <div class="ec-rtl-switch">
                    <div class="ec-rtl-btn">Rtl</div>
                    <div class="ec-rtl-on">On</div>
                    <div class="ec-rtl-off">Off</div>
                </div>
            </div>
        </div>
        <div class="ec-tools-sidebar-content">
            <h3>Language</h3>
            <div class="ec-change-lang">
                <span id="google_translate_element"></span>
            </div>
        </div>
        <div class="ec-tools-sidebar-content">
            <h3>Clear local storage</h3>
            <a class="clear-cach" href="javascript:void(0)">Clear Cache & Default</a>
        </div>
    </div>
</div>
<!-- Feature tools end -->

<!-- Vendor JS -->
<script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
<script src="assets/js/vendor/popper.min.js"></script>
<script src="assets/js/vendor/bootstrap.min.js"></script>
<script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
<script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>

<!--Plugins JS-->
<script src="assets/js/plugins/swiper-bundle.min.js"></script>
<script src="assets/js/plugins/countdownTimer.min.js"></script>
<script src="assets/js/plugins/scrollup.js"></script>
<script src="assets/js/plugins/jquery.zoom.min.js"></script>
<script src="assets/js/plugins/slick.min.js"></script>
<script src="assets/js/plugins/infiniteslidev2.js"></script>
<script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
<script src="assets/js/plugins/jquery.sticky-sidebar.js"></script>
<!-- Google translate Js -->
<script src="assets/js/vendor/google-translate.js"></script>
<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
    }
</script>
<!-- Main Js -->
<script src="assets/js/vendor/index.js"></script>
<script src="assets/js/main.js"></script>

<script src="assets/js/plugins/sweetalert2.min.js"></script>
<script src="assets/js/plugins/jquery.sweet-alert.init.js"></script>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        var passwordInput = document.getElementById('password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.innerHTML = '<i class="fas fa-eye-slash" aria-hidden="true"></i>';
        } else {
            passwordInput.type = 'password';
            this.innerHTML = '<i class="fas fa-eye" aria-hidden="true"></i>';
        }
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        var confirmPasswordInput = document.getElementById('confirmpassword');
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
            this.innerHTML = '<i class="fas fa-eye-slash" aria-hidden="true"></i>';
        } else {
            confirmPasswordInput.type = 'password';
            this.innerHTML = '<i class="fas fa-eye" aria-hidden="true"></i>';
        }
    });
</script>


</body>

</html>