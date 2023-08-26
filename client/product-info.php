<?php
include('navbar.php');
?>

<?php
include 'config/config.php';
include '../admin/Database.php';
$productObj = new Product($conn);
$id = $_GET['id'];
$products = $productObj->getProductwithId($id);
$producttemplate = $productObj->getProductData($id);
?>
<?php
session_start();
if (!isset($_SESSION['order_id'])) {
    // Generate a new value for $orderId
    $orderId = time() . '_' . mt_rand(1000, 9999);
    // Set the session variable
    $_SESSION['order_id'] = $orderId;
} else {
    // Retrieve the existing value from the session variable
    $orderId = $_SESSION['order_id'];
}
?>
<!-- Header End  -->

<!-- ekka Cart Start -->
<div class="ec-side-cart-overlay"></div>

<!-- ekka Cart End -->

<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <!-- <h2 class="ec-breadcrumb-title">Single Products</h2> -->
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="ec-breadcrumb-item active">Dashboard</li>
                        </ul>
                        <!-- ec-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ec breadcrumb end -->

<!-- Sart Single product -->
<section class="ec-page-content section-space-p">
    <div class="checkout_page">
        <div class="container">
            <div class="row">
                <div class="ec-pro-rightside ec-common-rightside col-lg-12 order-lg-last col-md-12 order-md-first">

                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="single-pro-img">
                                    <div class="single-product-scroll">
                                        <div class="single-product-cover">
                                            <div class="single-slide zoom-image-hover">
                                                <img class="img-responsive"
                                                    src="../admin/upload/<?php echo $products[0]['image']; ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-pro-desc">
                                    <div class="single-pro-content">
                                        <h5 class="ec-single-title">
                                            <?php echo $products[0]['prod_name']; ?>
                                        </h5>
                                        <div class="ec-single-rating-wrap">
                                        </div>
                                        <div class="ec-single-desc">
                                            <?php echo $products[0]['details'] ?>
                                        </div>
                                        <div class="ec-single-sales">
                                            <?php
                                            foreach ($producttemplate as $product) {
                                                echo $product['template_fields']['template_fields'];
                                            }
                                            ?>
                                            <div class="ec-single-cart">
                                                <button class="btn btn-primary" id="previewButton">Preview</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ec-single-pro-tab">
                        <div class="ec-single-pro-tab-wrapper">
                            <div class="ec-single-pro-tab-nav">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#ec-spt-nav-details" role="tablist">Detail</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="tab-content  ec-single-pro-tab-content">
                                <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                    <div class="ec-single-pro-tab-desc">
                                        <p>

                                        </p>
                                        <ul>
                                            <li>
                                                <?php echo $products[0]['details'] ?>
                                            </li>

                                    </div>
                                </div>
                                <div id="ec-spt-nav-info" class="tab-pane fade">
                                    <div class="ec-single-pro-tab-moreinfo">
                                        <ul>

                                        </ul>
                                    </div>
                                </div>
                                <form method="POST" action="product-checkout.php">
                                    <input type="hidden" name="price" id="displayPrice">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <!-- Add a value for the id -->
                                    <span class="ec-check-order-btn">
                                        <button class="btn btn-primary" type="submit"
                                            href="product-checkout.php">Checkout</button>
                                    </span>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End Single product -->

<!-- Related Product Start -->
<script>
    document.getElementById('stampPrice').addEventListener('input', function () {
        var price = document.getElementById('stampPrice').value;
        document.getElementById('displayPrice').value = price;
    });
</script>
<!-- Related Product end -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    var id = <?php echo json_encode($id); ?>;
    var order_id = <?php echo json_encode($_SESSION['order_id']); ?>;
    document.getElementById('previewButton').addEventListener('click', function () {

        var previewContent = '';
        var inputElements = document.querySelectorAll('.ec-single-sales input');
        var data = [];
        inputElements.forEach(function (input) {
            label = input.previousElementSibling.textContent;
            value = input.value;
            previewContent += '<p>' + label + ': ' + value + '</p>';
            data.push({
                label: label,
                value: value
            });
        });

        // Create a Fabric.js canvas instance
        var canvas = new fabric.Canvas('canvas');

        // Load the user-defined image
        image = new fabric.Image.fromURL('assets/images/image-write/preview.png', function (img) {
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
                        text: 'Save',
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
                    data.forEach(function (item) {
                        item.id = id;
                        item.order_id = order_id;
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'save_data.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {

                                    var response = JSON.parse(xhr.responseText);
                                    if (response.success) {
                                        swal({
                                            title: 'Data Saved',
                                            text: 'Your data has been saved successfully.',
                                            icon: 'success'

                                        });
                                    } else {
                                        swal({
                                            title: 'Failed to Save Data',
                                            text: 'There was an error processing your request. Please try again later.',
                                            icon: 'error'
                                        });

                                    }
                                } else {
                                    swal({
                                        title: 'Request Failed',
                                        text: 'There was an error processing your request. Please try again later.',
                                        icon: 'error'
                                    });

                                }
                            }
                        };
                        xhr.send(JSON.stringify(item));
                        event.preventDefault();
                    });
                } else {
                    // Cancel button clicked
                    // Add your logic here if needed
                }
            });
        });

    });
</script>
<?php
include('footer.php');
?>