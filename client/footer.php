<!-- Footer Start -->
<footer class="ec-footer section-space-mt">
    <div class="footer-container">
        <!-- <div class="footer-offer">
                <div class="container">
                    <div class="row">
                        <div class="text-center footer-off-msg">
                            <span>Win a contest! Get this limited-editon</span><a href="#" target="_blank">View
                                Detail</a>
                        </div>
                    </div>
                </div>
            </div> -->

        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Footer social Start -->
                    <div class="col text-left footer-bottom-left">
                        <div class="footer-bottom-social">
                            <span class="social-text text-upper">Follow us on:</span>

                        </div>
                    </div>
                    <!-- Footer social End -->
                    <!-- Footer Copyright Start -->
                    <div class="col text-center footer-copy">
                        <div class="footer-bottom-copy ">
                            <div class="ec-copy">Copyright © 2023 <a class="site-name text-upper" href="#">Legal
                                    Karnataka<span>.</span></a>. All Rights Reserved</div>
                        </div>
                    </div>
                    <!-- Footer Copyright End -->
                    <!-- Footer payment -->
                    <div class="col footer-bottom-right">
                        <div class="footer-bottom-payment d-flex justify-content-end">


                        </div>
                    </div>
                    <!-- Footer payment -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->

<!-- Modal -->
<div class="modal fade" id="ec_quickview_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>
    </div>
</div>
<!-- Modal end -->

<!-- Cart Floating Button -->
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


<!-- Include the Fabric.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>

<script>
    document.getElementById('previewButton').addEventListener('click', function () {
        var previewContent = '';
        var inputElements = document.querySelectorAll('.ec-single-sales input');
        inputElements.forEach(function (input) {
            var label = input.previousElementSibling.textContent;
            var value = input.value;
            previewContent += '<p>' + label + ': ' + value + '</p>';
        });

        // Create a Fabric.js canvas instance
        var canvas = new fabric.Canvas('canvas');

        // Load the user-defined image
        var image = new fabric.Image.fromURL('assets/images/image-write/preview.png', function (img) {
            // Set the dimensions of the canvas to match the image
            canvas.setWidth(img.width);
            canvas.setHeight(img.height);

            // Add the image to the canvas
            canvas.add(img);

            // Set the font style for the text
            var textOptions = {
                fontFamily: 'Arial',
                fontSize: 35,
                fill: 'black',
                textAlign: 'left', // Align the text to the left
                editable: false,
            };

            // Write the preview content on the canvas
            var lines = previewContent.split('<p>');
            lines.shift(); // Remove the first empty line
            var lineHeight = 40; // Adjust the line height as needed
            var startX = 100; // Set the X position for left alignment
            var startY = 330; // Set the Y position for top alignment
            lines.forEach(function (line, index) {
                var y = startY + (index * lineHeight);
                var text = new fabric.Text(line.replace('</p>', ''), {
                    ...textOptions,
                    top: y,
                    left: startX,
                    width: canvas.getWidth(), // Set the width of the textbox to match the canvas width
                });
                canvas.add(text);
            });

            // Render the canvas to generate the image data
            canvas.renderAll();

            // Get the data URL of the canvas as an image
            var imageDataUrl = canvas.toDataURL('png');

            // Create the SweetAlert popup
            swal({
                title: 'Preview',
                content: {
                    element: 'img',
                    attributes: {
                        src: imageDataUrl,
                        style: 'max-width: 100%;'
                    }
                },
                buttons: {
                    cancel: {
                        text: 'Cancel',
                        value: null,
                        visible: true,
                        className: '',
                        closeModal: true,
                    },
                    confirm: {
                        text: 'Proceed',
                        value: true,
                        visible: true,
                        className: '',
                        closeModal: true
                    }
                },
                closeOnClickOutside: false,
                dangerMode: true
            }).then(function (result) {
                // Handle the result of the SweetAlert popup
                if (result) {
                    var data = {
                        label: label,
                        value: value
                    };

                    // Make an AJAX request to send the data to the server
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'save_data.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                // Request successful
                                var response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    // Data saved successfully
                                    // Add your logic here if needed
                                } else {
                                    // Data saving failed
                                    // Add your logic here if needed
                                }
                            } else {
                                // Request failed
                                // Add your logic here if needed
                            }
                        }
                    };
                    xhr.send(JSON.stringify(data));
                } else {
                    // Cancel button clicked
                    // Add your logic here if needed
                }
            });
        });
        event.preventDefault();
    });
</script>

<!-- Create a canvas element -->

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

<!-- Main Js -->
<script src="assets/js/vendor/index.js"></script>
<script src="assets/js/main.js"></script>


</body>

</html>