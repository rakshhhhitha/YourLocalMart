
<?php

include('../server/connection.php');

if(isset($_POST['create_product'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['category'];
    $product_color = $_POST['product_color'];
    $product_special_offer = $_POST['special_offer'];
    $product_image = $_POST['image'];
    $product_image2 = $_POST['image2'];



    //create new product
    $stmt = $conn->prepare("INSERT INTO products (product_name,product_price,product_category,product_color,product_special_offer,product_image,product_image2)
                            VALUES (?,?,?,?,?,?,?) ");
    $stmt->bind_param('sssssss',$product_name,$product_price, $product_category, $product_color ,$product_special_offer,$product_image ,$product_image2);

    if($stmt->execute()){
        header('location: products.php?product_created=Product has been created successfully');

    }else{
        header('location: products.php?product_failed=Error occured, Try again!');
    }

}




?>