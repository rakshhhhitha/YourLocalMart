<?php

session_start();

?>


<?php include('layouts/header.php'); ?>

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span>
                    </p>
                    <h1 class="mb-0 bread">Payment</h1>
                </div>
            </div>
        </div>
    </div>


    <!--payment-->

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 ftco-animate">
                   
                    <p><?php if(isset($_GET['order_status'])) {echo $_GET['order_status']; }?></p>
                    <p>Total payment : ₹
                        <?php if(isset($_SESSION['total'])) {echo $_SESSION['total']; }?>
                    </p>
                    <?php if(isset($_SESSION['total'])) {?>
                    <input type="submit" class="btn btn-primary py-3 px-4" value="Pay Now" />
                    <?php } ?>

                    <?php if(isset($_GET['order_status']) && $_GET['order_status'] == "Not Paid") {?>
                    <input type="submit" class="btn btn-primary py-3 px-4" value="Pay Now" />
                    <?php } ?>
                </div>
                </div> <!-- .col-md-8 -->
            </div>
        </div>
    </section> <!-- .section -->

    
    <?php  include('layouts/footer.php'); ?> 