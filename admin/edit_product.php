<?php include('header.php'); ?>

<?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
} else {
    header('location: products.php');
    exit;
}

if (isset($_POST['edit_btn'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_color = $_POST['product_color'];
    $offer_price = $_POST['special_offer'];
    $category = $_POST['category'];

    $stmt1 = $conn->prepare("UPDATE products SET product_name=?, product_price=?, product_color=?, product_special_offer=?, product_category=? WHERE product_id=?");
    $stmt1->bind_param('sssssi', $product_name, $product_price, $product_color, $offer_price, $category, $product_id);

    if ($stmt1->execute()) {
        header('location: products.php?edit_success_message=Product has been updated successfully');
        exit;
    } else {
        header('location: products.php?edit_failure_message=Error Occurred Try Again');
        exit;
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div>
            <?php include('sidemenu.php'); ?>
        </div>
        <div class="container-fluid">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <h1 class="h2 mt-3">Dashboard</h1>
                <h2>Edit Product</h2>
                <div class="table-responsive">
                    <div class="mx-auto container">
                        <form action="" method="POST" id="edit-btn" enctype="multipart/form-data">
                            <p style="color:red;"><?php if (isset($_GET['error'])) {
                                                        echo $_GET['error'];
                                                    } ?></p>

                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

                            <div class="form-group mt-2">
                                <label>Product Name</label>
                                <input type="text" class="form-control" value="<?php echo $product['product_name'] ?>" id="product-name" name="product_name" placeholder="Product Name" />
                            </div>
                            <div class="form-group mt-2">
                                <label>Product Price</label>
                                <input type="text" class="form-control" value="<?php echo $product['product_price']; ?>" id="Product Price" name="product_price" placeholder="Product Price" />
                            </div>
                            <div class="form-group mt-2">
                                <label>Category</label>
                                <select class="form-select" required name="category">
                                    <option value="fruits">Fruits</option>
                                    <option value="vegetables">Vegetables</option>
                                    <option value="meat">Meat</option>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label>Product Color</label>
                                <input type="text" class="form-control" value="<?php echo $product['product_color']; ?>" id="product-color" name="product_color" placeholder="Product Color" />
                            </div>
                            <div class="form-group mt-2">
                                <label>Product Offer</label>
                                <input type="text" class="form-control" value="<?php echo $product['product_special_offer']; ?>" id="product-offer" name="special_offer" placeholder="Product Offer" />
                            </div>

                            <div class="form-group mt-3">
                                <input type="submit" class="btn btn-primary" name="edit_btn" value="Edit" />
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
