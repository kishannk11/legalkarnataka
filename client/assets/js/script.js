
var images = document.querySelectorAll('.product-image');
var currentIndex = 0;

function rotateImages() {
    // Hide all images
    for (var i = 0; i < images.length; i++) {
        images[i].style.display = 'none';
    }

    // Show the current image
    images[currentIndex].style.display = 'block';

    // Increment the current index
    currentIndex++;
    if (currentIndex >= images.length) {
        currentIndex = 0;
    }

    // Call the rotateImages function again after a certain time interval (e.g., 3 seconds)
    setTimeout(rotateImages, 3000);
}

// Start rotating the images
rotateImages();






var images = document.querySelectorAll('.product-image');
var currentIndex = 0;

function rotateImages() {
    // Hide all images
    for (var i = 0; i < images.length; i++) {
        images[i].style.display = 'none';
    }

    // Show the current image
    images[currentIndex].style.display = 'block';

    // Increment the current index
    currentIndex++;
    if (currentIndex >= images.length) {
        currentIndex = 0;
    }

    // Call the rotateImages function again after a certain time interval (e.g., 3 seconds)
    setTimeout(rotateImages, 3000);
}

// Start rotating the images
rotateImages();


var stampPriceElement = document.getElementById('stampPrice');
var displayPriceElement = document.getElementById('displayPrice');
if (!stampPriceElement) {
    displayPriceElement.style.display = 'none';
    document.getElementById('displayPrice1').value = ''; // Set empty value
} else {
    stampPriceElement.addEventListener('input', function () {
        var price = document.getElementById('stampPrice').value;
        document.getElementById('displayPrice1').value = price;
    });
}