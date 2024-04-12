<?php

include('server/connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE PRODUCT_CATEGORY='FRUITS'");
$stmt->execute();
$product = $stmt->get_result(); // []

?>



<?php include('layouts/header.php') ?>

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="index.html">Product</a></span> <span>FARM FRESH FRUITS</span></p>
            <h1 class="mb-0 bread">FRUITS</h1>
          </div>
        </div>
      </div>
    </div>


<!--fruits product backend-->

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Fruits</span>
                <h2 class="mb-4">Fruits</h2>
                <p>Farm fresh fruits</p>
            </div>
        </div>           
    </div>
    <div class="container">
        <div class="row">
        <?php while($row = $product->fetch_assoc()){ ?>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <div class="img-prod">
                        <img class="img-fluid" src="<?php echo $row['product_image']; ?>" alt="Colorlib Template">
                    </div>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><span class="product-name"><?php echo $row['product_name']; ?></span></h3>
                        
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="price-sale">₹<?php echo $row['product_price']; ?></span></p>
                            </div>
                        </div>
                        <form method="POST" action="cart.php"> 
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" /> 
                            <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>" />
                            <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
                            <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />
                            <input type="hidden" name="product_quantity" value="1"/>

                          
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex"> 
                                    <button type="submit" class="buy-now d-flex justify-content-center align-items-center mx-1" name="add_to_cart">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </button> 
                                    <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                        <span><i class="ion-ios-heart"></i></span>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>

        </div>
    </div>
</section>







	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-6">
          	<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
          	<span>Get e-mail updates about our latest shops and special offers</span>
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="Enter email address">
                <input type="submit" value="Subscribe" class="submit px-3">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>


    <?php include('layouts/footer.php') ?>