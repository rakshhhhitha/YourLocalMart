<?php

include ('server/connection.php');

if (isset($_GET['product_id'])) {

    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    $product = $stmt->get_result();

    //no product id was given
} else {
    echo "No product found with the given ID.";
    //header('location: index.php');

}

?>



<?php include ('layouts/header.php'); ?>

<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a
                            href="index.html">Product</a></span> <span>Product Single</span></p>
                <h1 class="mb-0 bread">Product Single</h1>
            </div>
        </div>
    </div>
</div>


<!--single product backend-->

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Products</span>
                <h2 class="mb-4">Related Products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <?php while ($row = $product->fetch_assoc()) { ?>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="#" class="img-prod"><img class="img-fluid" src="<?php echo $row['product_image']; ?>"
                                alt="Colorlib Template">

                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="#"><?php echo $row['product_name']; ?></a></h3>
                            <h3><a href="#"><?php echo $row['product_quantity']; ?></a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span class="price-sale">₹<?php echo $row['product_price']; ?></span>
                                    </p>
                                </div>
                            </div>
                            <form method="POST" action="cart.php">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
                                <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>" />
                                <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
                                <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />
                                <input type="hidden" name="product_quantity"
                                    value="<?php echo $value['product_quantity']; ?>" min="1" />
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <button type="submit"
                                            class="buy-now d-flex justify-content-center align-items-center mx-1"
                                            name="add_to_cart">
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





<?php include ('layouts/footer.php'); ?>