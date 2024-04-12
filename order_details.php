<?php
session_start();
include ("server/connection.php");

if(isset($_GET['order_details_btn']) && isset($_GET['order_id'])){

    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id=? ");
    $stmt->bind_param('i',$order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();
}else{
    header('location: Account.php');
    exit;

}




?>


<?php  include('layouts/header.php'); ?> 

 <!-- order details -->
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <h1><center>Order Details</center> </h1>
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Price</th>
                                <th>Quantity</th>   
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $order_details->fetch_assoc()) { ?>
                                <tr class="text-center">
                                    <td class="product-name"><h3><?php echo $row['product_name']; ?></h3></td>
                                    <td class="image-prod">
                                        <div class="img" style="background-image:url(<?php echo $row['product_image']; ?>);"></div>
                                    </td>

                                    <td class="price">₹<?php echo $row['product_price']; ?></td>
                                    <td class="product-name"><h3><?php echo $row['product_quantity']; ?></h3></td>
                                    
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</section>


    

<?php  include('layouts/footer.php'); ?> 