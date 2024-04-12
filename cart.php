<?php
session_start();

if (isset($_POST['add_to_cart'])) {
  if (isset($_SESSION['cart'])) {
    $PRODUCT_ARRAY_IDS = array_column($_SESSION['cart'], "product_id");

    if (!in_array($_POST['product_id'], $PRODUCT_ARRAY_IDS)) {
      $PRODUCT_ARRAY = array(
        'product_id' => $_POST['product_id'],
        'product_name' => $_POST["product_name"],
        'product_price' => $_POST["product_price"],
        'product_image' => $_POST["product_image"],
        'product_quantity' => $_POST['product_quantity']
      );

      $_SESSION['cart'][$_POST['product_id']] = $PRODUCT_ARRAY;
    } else {
      echo '<script>alert("Product was already added to cart")</script>';
    }
  } else {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_image = $_POST["product_image"];
    $product_quantity = $_POST["product_quantity"];

    $PRODUCT_ARRAY = array(
      'product_id' => $product_id,
      'product_name' => $product_name,
      'product_price' => $product_price,
      'product_image' => $product_image,
      'product_quantity' => $product_quantity
    );

    $_SESSION['cart'][$product_id] = $PRODUCT_ARRAY;
  }
  //calculate total
  calculateTotalCart();


  //remove product
} else if (isset($_POST['remove_product'])) {
  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);

  calculateTotalCart();

} else if (isset($_POST['edit_quantity'])) {
  //we get id and product_quantity from the form
  $product_id = $_POST['product_id'];
  $product_quantity = $_POST['product_quantity'];
  //get the product array from the session
  $product_array = $_SESSION['cart'][$product_id];
  $_SESSION['cart'][$product_id]['product_quantity'] = $product_quantity;

  calculateTotalCart();
} else {
  //header('location: index.php');
}

function calculateTotalCart()
{
  $total = 0;
  foreach ($_SESSION['cart'] as $key => $value) {
    $product = $_SESSION['cart'][$key];
    $price = $product['product_price'];
    $quantity = $product['product_quantity'];
    $total = $total + ($price * $quantity);
  }
  $_SESSION['total'] = $total;
}

?>






<!--header-->
<?php include('layouts/header.php');?>

  <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
          <h1 class="mb-0 bread">My Cart</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-cart">
    <div class="container">
      <div class="row">
        <div class="col-md-12 ftco-animate">
          <div class="cart-list">
            <table class="table">
              <thead class="thead-primary">


                <tr class="text-center">
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>Product name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>

              <tbody>
                <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                  <tr class="text-center">
                    <td>
                      <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                        <button type="submit" name="remove_product" class="product-remove">
                          <img src="https://static-00.iconduck.com/assets.00/delete-icon-1864x2048-bp2i0gor.png"
                            name="remove_product" alt="Delete icon" style="width: 24px; height: 24px;">
                        </button>
                      </form>

                    </td>
                    <td class="image-prod">
                      <div class="img" style="background-image:url(<?php echo $value['product_image']; ?>);"></div>
                    </td>

                    <td class="product-name">
                      <h3>
                        <?php echo $value['product_name']; ?>
                      </h3>

                    </td>

                    <td class="price">₹
                      <?php echo $value['product_price']; ?>
                    </td>

                    <td class="product_quantity">
                      <form method="POST" action="cart.php">
                        <div class="input-group mb-3">

                          <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                          <input type="number" class="product_quantity form-control input-number" name="product_quantity"
                            value="<?php echo $value['product_quantity']; ?>" min="1" />
                          <span class="input-group-btn">
                            <button class="edit-btn btn btn-outline-secondary" type="submit"
                              name="edit_quantity">Edit</button>
                          </span>
                        </div>
                      </form>
                    </td>


                    <td class="total">₹
                      <?php echo $value['product_quantity'] * $value['product_price']; ?>
                    </td>
                  </tr><!-- END TR-->

                <?php } ?>
              </tbody>

            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Cart Total</h3>
          <hr>
          <p class="d-flex total-price">
            <span>Total</span>
            <span>₹
              <?php echo $_SESSION['total']; ?>
            </span>
          </p>
        </div>
        <div>
          <form method="POST" action="checkout.php">
            <input type="submit" class="btn btn-primary py-3 px-4" value="Checkout" name="checkout" />
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php include('layouts/footer.php'); ?>