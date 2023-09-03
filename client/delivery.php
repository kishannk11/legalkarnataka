<?php
$deliveryPriceScript = "
<script>
    function initializeDeliveryPrice() {
        const deliveryRadios = document.querySelectorAll('input[name=\"radio-group\"]');
        const deliveryPrice = document.getElementById('delivery-price');

        deliveryRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked) {
                    const rate = radio.nextElementSibling.textContent.split(' - ')[1];
                    deliveryPrice.textContent = '₹' + rate;
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', initializeDeliveryPrice);
</script>
";
?>