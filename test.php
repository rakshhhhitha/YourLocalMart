<?php
include ('server/connection.php');

$categories = ['All', 'Fruits', 'Vegetables', 'Dairy']; // Define categories

// Pagination
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 8; // Number of products per page
$offset = ($page - 1) * $limit;

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    if ($category == 'All') {
        $stmt = $conn->prepare("SELECT * FROM products LIMIT ?, ?");
        $stmt->bind_param("ii", $offset, $limit);
    } else {
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? LIMIT ?, ?");
        $stmt->bind_param("sii", $category, $offset, $limit);
    }
} else {
    $stmt = $conn->prepare("SELECT * FROM products LIMIT ?, ?");
    $stmt->bind_param("ii", $offset, $limit);
}

$stmt->execute();
$product = $stmt->get_result();
?>

<?php include ('layouts/header.php'); ?>

<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span>
                </p>
                <h1 class="mb-0 bread">Products</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    <?php foreach ($categories as $cat) { ?>
                        <li><a href="?category=<?php echo $cat; ?>" <?php if (isset($_GET['category']) && $_GET['category'] == $cat)
                               echo 'class="active"'; ?>><?php echo $cat; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php while ($row = $product->fetch_assoc()) { ?>
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <div class="img-prod">
                                <img class="img-fluid" src="<?php echo $row['product_image']; ?>" alt="Colorlib Template">
                            </div>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><span class="product-name"><?php echo $row['product_name']; ?></span></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span
                                                class="price-sale">₹<?php echo $row['product_price']; ?></span></p>
                                    </div>
                                </div>
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
                                    <input type="hidden" name="product_image"
                                        value="<?php echo $row['product_image']; ?>" />
                                    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
                                    <input type="hidden" name="product_price"
                                        value="<?php echo $row['product_price']; ?>" />
                                    <input type="hidden" name="product_quantity" value="1" />
                                    <div class="bottom-area d-flex px-3">
                                        <div class="m-auto d-flex">
                                            <button type="submit"
                                                class="buy-now d-flex justify-content-center align-items-center mx-1"
                                                name="add_to_cart">
                                                <span><i class="ion-ios-cart"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    // Pagination
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM products");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $total_pages = ceil($data['total'] / $limit);

    ?>
    <div class="row mt-5">
        <div class="col text-center">
            <div class="block-27">
                <ul>
                    <?php if ($page > 1) { ?>
                        <li><a
                                href="?category=<?php echo isset($_GET['category']) ? $_GET['category'] : 'All'; ?>&page=<?php echo $page - 1; ?>">&lt;</a>
                        </li>
                    <?php } ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                        <li class="<?php if ($i == $page)
                            echo 'active'; ?>"><a
                                href="?category=<?php echo isset($_GET['category']) ? $_GET['category'] : 'All'; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>
                    <?php if ($page < $total_pages) { ?>
                        <li><a
                                href="?category=<?php echo isset($_GET['category']) ? $_GET['category'] : 'All'; ?>&page=<?php echo $page + 1; ?>">&gt;</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php include ('layouts/footer.php'); ?>