<?php 
session_start();
include('server/connection.php');
date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['place_order'])) {
    // Get user info from form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "on hold"; // Make sure this is the intended status
    $order_date = date('Y-m-d H:i:s');

    // Insert user info into 'orders' table
    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_phone, user_city, user_address, order_date)
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ississ', $order_cost, $order_status, $phone, $city, $address, $order_date);
    $stmt->execute();

    // Get the newly inserted order ID
    $order_id = $stmt->insert_id;

    // Insert each product from cart into 'order_items' table
    foreach($_SESSION['cart'] as $product) {
        $product_id = $product['product_id'];
        $product_name = $product['product_name']; 
        $product_image = $product['product_image']; 
        $product_price = $product['product_price']; 
        $product_quantity = $product['product_quantity'];  
    
        // Check if product name is not null before inserting into database
        if(!empty($product_name)) {
            $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, order_date)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt1->bind_param('iisssis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $order_date);
            $stmt1->execute();
        } else {
            // Handle the case where product name is null
            echo "Product name is null!";
        }
    }

    // Redirect user to payment page with success message
    header('location: payment.php?order_status=order placed successfully');
}
?>
