<?php
// Set your PayU credentials
$merchantKey = "Z5LxwB";
$salt = "BvrZHvmeBjkEdQxJrxlBIiVhVyjirOac";
$baseUrl = "https://test.payu.in/_payment"; // Sandbox URL, replace with production URL when ready

// Prepare data for the payment
$txnid = uniqid(); // Generate a unique transaction ID
$amount = "100.00"; // Amount in INR
$productInfo = "Sample Product";
$firstName = "John";
$email = "john@example.com";
$phone = "1234567890";
$udf1 = "";
$udf2 = "";
$udf3 = "";
$udf4 = "";
$udf5 = "";

// Create hash
$hashSequence = $merchantKey . "|" . $txnid . "|" . $amount . "|" . $productInfo . "|" . $firstName . "|" . $email . "|" . $udf1 . "|" . $udf2 . "|" . $udf3 . "|" . $udf4 . "|" . $udf5 . "||||||" . $salt;
$hash = strtolower(hash("sha512", $hashSequence));

// Prepare form data
$data = [
    "key" => $merchantKey,
    "txnid" => $txnid,
    "amount" => $amount,
    "productinfo" => $productInfo,
    "firstname" => $firstName,
    "email" => $email,
    "phone" => $phone,
    "udf1" => $udf1,
    "udf2" => $udf2,
    "udf3" => $udf3,
    "udf4" => $udf4,
    "udf5" => $udf5,
    "surl" => "http://localhost/legalkarnataka/client/success.php",
    "furl" => "http://localhost/legalkarnataka/client/success.php",
    "hash" => $hash,
];
?>

<!-- Create a form to submit payment data to PayU -->
<form method="post" action="<?php echo $baseUrl; ?>" name="payuForm" id="payuForm">
    <?php
    foreach ($data as $key => $value) {
        echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
    }
    ?>
</form>

<!-- Automatically submit the form when the page loads -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("payuForm").submit();
    });
</script>