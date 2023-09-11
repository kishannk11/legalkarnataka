<?php
include 'navbar.php';
?>
<?php
if (isset($_GET['txnid'])) {
    $txnid = $_GET['txnid'];
}
?>
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Order Success</h2>
                    <h2 class="ec-title">Order Status</h2>
                    <p class="sub-title mb-3">
                        <?php echo $txnid; ?>
                    </p>
                </div>
            </div>
            <div class="ec-common-wrapper">

            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';
?>