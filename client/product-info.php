<?php
include('navbar.php');
?>

<?php
include 'config/config.php';
$productObj = new Product($conn);
$id = $_GET['id'];
$products = $productObj->getProductwithId($id);
$producttemplate = $productObj->getProductData($id);
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
                            <li class="ec-breadcrumb-item"><a href="#">Home</a></li>
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
    <?php
    if (empty($products)) {
        echo "No product found for this ID.";
    } else {
        ?>
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
                                            <div class="single-product-scroll">
                                                <?php
                                                $productimage = new Product($conn);
                                                $productId = $products[0]['id'];

                                                $productImages = $productimage->getProductImage($productId);

                                                ?>
                                                <a class="ec-header-btn ec-header-wishlist ec-video-icon"
                                                    data-link-action="quickview" title="Product Player"
                                                    data-bs-toggle="modal" data-bs-target="#ec_product_player_modal">
                                                    <div class="header-icon"><i class="fi-rr-video-camera-alt"></i></div>
                                                </a>
                                                <div class="single-product-cover">
                                                    <?php foreach ($productImages as $imageName): ?>
                                                        <div class="single-slide zoom-image-hover">
                                                            <img class="img-responsive"
                                                                src="../admin/upload/<?php echo htmlspecialchars($imageName, ENT_QUOTES, 'UTF-8'); ?>"
                                                                alt="">
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="single-nav-thumb">
                                                    <?php foreach ($productImages as $imageName): ?>
                                                        <div class="single-slide">
                                                            <img class="img-responsive" width="100" height="100"
                                                                src="../admin/upload/<?php echo htmlspecialchars($imageName, ENT_QUOTES, 'UTF-8'); ?>"
                                                                alt="">
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-pro-desc">
                                        <div class="single-pro-content">
                                            <h5 class="ec-single-title">
                                                <?php echo htmlspecialchars($products[0]['prod_name'], ENT_QUOTES, 'UTF-8'); ?>
                                            </h5>

                                            <div class="ec-single-rating-wrap">
                                                <b>
                                                    ₹
                                                    <?php echo htmlspecialchars($products[0]['price'], ENT_QUOTES, 'UTF-8'); ?>
                                                </b>
                                            </div>
                                            <div class="ec-single-desc">
                                                <?php echo htmlspecialchars($products[0]['details'], ENT_QUOTES, 'UTF-8'); ?>
                                            </div>
                                            <div class="ec-single-sales">
                                                <?php foreach ($producttemplate as $product): ?>
                                                    <?php echo $product['template_fields']['template_fields']; ?>
                                                <?php endforeach; ?>

                                            </div>
                                            <div class="ec-single-desc">

                                                <form method="POST" action="add-to-cart.php">
                                                    <div id="display">
                                                        <b><label class="form-label">Stamp Paper Price</label></b>
                                                        <input type="text" class="form-control" name="price"
                                                            id="displayPrice1" readonly>
                                                    </div>
                                                    &nbsp;
                                                    &nbsp;
                                                    <div class="mb-3">
                                                        <label class="form-label">Additional Files</label>
                                                        <input type="file" class="form-control" name="files[]"
                                                            id="fileInput" multiple>
                                                    </div>
                                                    <div class="ec-single-cart">
                                                        <div class="button-group">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>">
                                                            <button class="btn btn-primary" name="submit" type="submit">Add
                                                                to
                                                                cart</button>

                                                        </div>

                                                    </div>
                                                </form>
                                                &nbsp;
                                                &nbsp;
                                                <div class="button-group">
                                                    <button class="btn btn-primary" id="previewButton">Preview</button>
                                                </div>

                                            </div>
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
                                    <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-details"
                                        role="tablist">Additional File Info</a>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-content  ec-single-pro-tab-content">
                            <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                <div class="ec-single-pro-tab-desc">
                                    <p>

                                    </p>
                                    <ul>
                                        <?php
                                        $details = explode("\n", $products[0]['additionalfiles']);
                                        foreach ($details as $detail) {
                                            echo '<li>' . htmlspecialchars($detail, ENT_QUOTES, 'UTF-8') . '</li>';
                                        }
                                        ?>
                                    </ul>

                                </div>
                            </div>
                            <div id="ec-spt-nav-info" class="tab-pane fade">
                                <div class="ec-single-pro-tab-moreinfo">
                                    <ul>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var id = <?php echo json_encode($id); ?>;
    var order_id = <?php echo json_encode($_SESSION['order_id']); ?>;
    document.getElementById('previewButton').addEventListener('click', function () {
        var inputElements = document.querySelectorAll('.ec-single-sales input');
        var isEmpty = false;
        inputElements.forEach(function (input) {
            if (input.value.trim() === '') {
                isEmpty = true;
            }
        });
        if (isEmpty) {
            swal({
                title: 'Validation Error',
                text: 'All fields are required.',
                icon: 'error',
            });
        } else {
            var previewContent = '';
            var inputElements = document.querySelectorAll('.ec-single-sales input');
            var data = [];
            inputElements.forEach(function (input) {
                label = input.previousElementSibling.textContent;
                value = input.value;
                previewContent += '<p>' + label + ' -  ' + value + '</p>';
                data.push({
                    label: label,
                    value: value
                });
            });
            // Create a Fabric.js canvas instance 
            var canvas = new fabric.Canvas('canvas');
            // Load the user-defined image 
            image = new fabric.Image.fromURL('assets/images/image-write/preview.jpeg', function (img) {
                // Set the dimensions of the canvas to match the image 
                canvas.setWidth(img.width);
                canvas.setHeight(img.height);
                // Add the image to the canvas 
                canvas.add(img);
                // Set the font style for the text 
                var textOptions = {
                    fontFamily: 'Arial',
                    fontSize: 23,
                    fill: 'black',
                    textAlign: 'left', // Align the text to the left 
                    editable: false,
                    fontWeight: 'bold',
                };
                // Write the preview content on the canvas 
                var lines = previewContent.split('<p>');
                lines.shift(); // Remove the first empty line 
                var lineHeight = 45; // Adjust the line height as needed 
                var startX = 157; // Set the X position for left alignment 
                var startY = 560; // Set the Y position for top alignment 
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
        }
    });
</script>
<script>
    const fileInput = document.getElementById('fileInput');

    fileInput.addEventListener('change', function () {
        const formData = new FormData();
        const files = fileInput.files;

        for (let i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'file_save.php?id=' + id, true); // Pass the id as a query parameter
        xhr.onload = function () {
            if (xhr.status === 200) {
                swal("Success", "File(s) uploaded successfully", "success");
            } else {
                swal("Error", "Error uploading file(s)", "error");
            }
        };

        xhr.send(formData);
    });
</script>
<script>
    var stampPriceElement = document.getElementById('stampPrice');
    var displayPriceElement = document.getElementById('displayPrice1');
    var display = document.getElementById('display');
    if (!stampPriceElement) {
        displayPriceElement.style.display = 'none';
        display.style.display = 'none';
        document.getElementById('displayPrice1').value = ''; // Set empty value
    } else {
        stampPriceElement.addEventListener('input', function () {
            var price = document.getElementById('stampPrice').value;
            document.getElementById('displayPrice1').value = price;
        });
    }
</script>

<?php
include('footer.php');
?>