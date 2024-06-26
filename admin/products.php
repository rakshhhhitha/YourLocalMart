<?php include ('header.php'); ?>

<?php

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit;
}
?>




<?php
//1.determine page no
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    //if user has already entered page then page number is the one that they selected
    $page_no = $_GET['page_no'];
} else {
    //if user just entered the page then default page is 1
    $page_no = 1;
}

//2.return number of orders
$stmt1 = $conn->prepare("SELECT count(*) AS total_records FROM products");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();


//3.orders per page
$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = ceil($total_records / $total_records_per_page);


//4.get all products
$stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
$stmt2->execute();
$products = $stmt2->get_result();

?>


<div class="container-fluid">
    <div class="row">
        <div>
            <?php include ('sidemenu.php'); ?>
        </div>
        <div class="container-fluid">
    <div class="row">
        <div>
            <?php include('sidemenu.php'); ?>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
            <h1 class="h2 mt-3">Dashboard</h1>
            <!-- Main content goes here -->
            <p>Welcome to YourLocalMart Admin Dashboard!</p>

            <!-- Sample Table -->
            <h2>Products</h2>


            <?php if(isset($_GET['edit_success_message'])){ ?> 
                 <p class="text-center" style="color: green;" ><?php echo $_GET['edit_success_message'];?></p>
                <?php } ?>

                <?php if(isset($_GET['edit_failure_message'])){ ?> 
                 <p class="text-center" style="color: red;" ><?php echo $_GET['edit_failure_message'];?></p>
                <?php } ?>

                <?php if(isset($_GET['deleted_successfully'])){ ?> 
                 <p class="text-center" style="color: green;" ><?php echo $_GET['deleted_successfully'];?></p>
                <?php } ?>

                <?php if(isset($_GET['deleted_failure'])){ ?> 
                 <p class="text-center" style="color: red;" ><?php echo $_GET['deleted_failure'];?></p>
                <?php } ?>
                <?php if(isset($_GET['product_created'])){ ?> 
                 <p class="text-center" style="color: green;" ><?php echo $_GET['product_created'];?></p>
                <?php } ?>

                <?php if(isset($_GET['product_failed'])){ ?> 
                 <p class="text-center" style="color: red;" ><?php echo $_GET['product_failed'];?></p>
                <?php } ?>



            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Porduct ID</th>
                        <th>Product Image</th>
                        <th>Product Name</th>   
                        <th>Product Price</th>
                        <th>Product category</th>
                        <th>Product color</th>
                        <th>Product offer</th>
                        <th>Edit</th>
                        <th>Delete</th> 
                    </tr>
                </thead>
                <tbody>

                <?php foreach($products as $product ) {?>
                    <tr>
                        <td><?php echo $product['product_id'];?></td>
                        <td><img src="<?php echo $product['product_image'];?>" style="width: 70px; height: 70px;"></td>

                        <td><?php echo $product['product_name'];?></td>
                        <td><?php echo $product['product_price'];?></td>
                        <td><?php echo $product['product_category'];?></td>
                        <td><?php echo $product['product_color'];?></td>
                        <td><?php echo $product['product_special_offer'];?></td>
                        <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id']; ?>">Edit</a></td>
                        <td><a class="btn btn-primary" href="delete_product.php?product_id=<?php echo $product['product_id']; ?>">Delete</a></td>
                    </tr>
                    
                <?php } ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page Navigation example" class="mx-auto">
                <ul class="pagination mt-5 mx-auto">
                    <li class="page-item <?php if ($page_no <= 1) { echo 'disabled'; } ?>">
                        <a href="<?php if ($page_no <= 1) { echo '#'; } else { echo "?page_no=" . ($page_no - 1); } ?>" class="page-link"> Previous</a>
                    </li>

                    <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                    <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>
                    <?php if ($page_no >= 3) { ?>
                        <li class="page-item"><a href="" class="page-link">...</a></li>
                        <li class="page-item"><a href="<?php echo "?page_no=" . ($page_no); ?>" class="page-link"><?php echo $page_no; ?></a></li>
                    <?php } ?>

                    <li class="page-item <?php if ($page_no >= $total_no_of_pages) { echo 'disabled'; } ?>">
                        <a href="<?php if ($page_no >= $total_no_of_pages) { echo '#'; } else { echo "?page_no=" . ($page_no + 1); } ?>" class="page-link">Next</a>
                    </li>
                </ul>
            </nav>
        </main>
    </div>
</div>


        

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>