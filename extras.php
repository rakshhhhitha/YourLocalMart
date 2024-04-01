
<section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<a href="images/product-1.jpg" class="image-popup"><img src="images/product-1.jpg" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3>Bell Pepper</h3>
    				<div class="rating d-flex">
							<p class="text-left mr-4">
								<a href="#" class="mr-2">5.0</a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
							</p>
							<p class="text-left mr-4">
								<a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
							</p>
							<p class="text-left">
								<a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
							</p>
						</div>
    				<p class="price"><span>$120.00</span></p>
    				<p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until.
						</p>
						<div class="row mt-4">
							<div class="col-md-6">
								<div class="form-group d-flex">
		              <div class="select-wrap">
	                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                  <select name="" id="" class="form-control">
	                  	<option value="">Small</option>
	                    <option value="">Medium</option>
	                    <option value="">Large</option>
	                    <option value="">Extra Large</option>
	                  </select>
	                </div>
		            </div>
							</div>
							<div class="w-100"></div>
							<div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   <i class="ion-ios-remove"></i>
	                	</button>
	            		</span>
	             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
	             	<span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="ion-ios-add"></i>
	                 </button>
	             	</span>
	          	</div>
	          	<div class="w-100"></div>
	          	<div class="col-md-12">
	          		<p style="color: #000;">600 kg available</p>
	          	</div>
          	</div>
          	<p><a href="cart.html" class="btn btn-black py-3 px-5">Add to Cart</a></p>
    			</div>
    		</div>
    	</div>
    </section>





	<td>
							<form method="POST" action="cart.php">
								<input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
								
									<button type="submit" name="remove_product" value="remove" class="product-remove bigger-button">
										<span class="ion-ios-close"></span>
									</button>
							</form>
							</td>







<?php 

session_start();

if(isset($_POST['add_to_cart'])){

	//if user has already added a product to the cart
	if(isset($_SESSION['cart'])){

		$products_array_ids = array_column($_SESSION['cart'],"product_id");
		//if product has already been added to cart or not
		if( !in_array($_POST['product_id'],$products_array_ids) ){

			$product_id= $_POST['product_id']

			$product_array = array(
				'product_id' => $_POST['product_id'],
				'product_name' => $_POST['product_name'],
				'product_price' => $_POST['product_price'],
				'product_image' => $_POST['product_image'],
				'product_quantity' =>  $_POST['product_quantity']
			);

			$_SESSION['cart'][$product_id] = $product_array;
	



			//product has already been added to the cart
		}else{

			echo '<script>alert("Product was already added to the cart"); </script>';
			
		}

	//if this is the first product	
	}else{

				$product_id = $_POST['product_id'];
				$product_name = $_POST['product_name'];
				$product_price = $_POST['product_price'];
				$product_image = $_POST['product_image'];
				$product_quantity =  $_POST['product_quantity'];
			
				$product_array = array(
					'product_id' => $_POST['product_id'],
					'product_name' => $_POST['product_name'],
					'product_price' => $_POST['product_price'],
					'product_image' => $_POST['product_image'],
					'product_quantity' =>  $_POST['product_quantity']
				);
	
				$_SESSION['cart'][$product_id] = $product_array;


		
	

			}



//remove product from the cart
}else if(isset($_POST['remove_product'])){

	$product_id =$_POST['product_id'];
	unset($_SESSION['cart'][$product_id]);

}


else{
	//header('location: index.php');

}


?>








<tbody>

<?php foreach($_SESSION['cart'] as $key => $value){ ?>


  <tr class="text-center">

	<!--remove -->
	<form method="POST" action="cart.php">
		<input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />

	   <td type="submit" name="remove_product" value="remove" class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>
	</form>


	<td class="image-prod"><div class="img" style="background-image:url(<?php echo $value['product_image'];?>);"></div></td>
	
	<td class="product-name">
		<h3><?php echo $value['product_name'];?></h3>
	</td>
	
	<td class="price">₹<?php echo $value['product_price'];?></td>
	
	<td class="quantity">
		

	<div class="input-group mb-3">
		<input type="number" name="product_quantity" class="quantity form-control input-number" value="<?php echo $value['product_quantity'] ?? 1; ?>" min="1">
		<span class="input-group-btn">
			<a class="edit-btn btn btn-outline-secondary" href="#">Edit</a>
		</span>
	</div>



  </td>
	
	<td class="total">₹<?php echo $value['product_price'];?></td>
  </tr><!-- END TR-->

<?php } ?>

</tbody>





<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style2.css">