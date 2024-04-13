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
$stmt1 = $conn->prepare("SELECT count(*) AS total_records FROM orders");
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


//4.get all orders
$stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");
$stmt2->execute();
$orders = $stmt2->get_result();

?>


<div class="container-fluid">
    <div class="row">
        <div>
            <?php include ('sidemenu.php'); ?>
        </div>
        

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
            <h1 class="h2 mt-3">Dashboard</h1>
            <!-- Main content goes here -->
            <p>Welcome to YourLocalMart Admin Dashboard!</p>

            <!-- Sample Table -->
            <h2>Orders</h2>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Status</th>
                        <th>User ID</th>
                        <th>Order Date</th>
                        <th>User Phone</th>
                        <th>User Address</th> 
                    </tr>
                </thead>
                <tbody>

                <?php foreach($orders as $order ) {?>
                    <tr>
                        <td><?php echo $order['order_id'];?></td>
                        <td><?php echo $order['order_status'];?></td>
                        <td><?php echo $order['user_id'];?></td>
                        <td><?php echo $order['order_date'];?></td>
                        <td><?php echo $order['user_phone'];?></td>
                        <td><?php echo $order['user_address'];?></td>
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