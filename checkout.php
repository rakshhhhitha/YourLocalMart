<?php

session_start();

if( !empty($_SESSION['cart'])){
	//let user in 


	//send user to home page
}else{
	header('location: index.php');
}

?>


<?php include('layouts/header.php') ?>

	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span>
					</p>
					<h1 class="mb-0 bread">Checkout</h1>
				</div>
			</div>
		</div>
	</div>


	<!--checkout-->
	
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-7 ftco-animate">

					<form action="place_order.php" method="POST" class="billing-form">
						<p class="text-center" style="color: red;">
						<?php if(isset($_GET['message'])) { echo $_GET['message'];} ?>
						<?php if(isset($_GET['message'])) {?>
							<a href="login.php" class='btn btn-primary py-3 px-4' >Login</a>

						<?php } ?>
								
					</p>
						<h3 class="mb-4 billing-heading">Billing Details</h3>
						<div class="row align-items-end">
							<div class="col-md-6">
								<div class="form-group">
									<label for="firstname">Name</label>
									<input type="text" class="form-control" name="name" placeholder="Name" required/>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="emailaddress">Email Address</label>
									<input type="text" class="form-control" name="email" placeholder="Email" required/>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="phone">Phone</label>
									<input type="text" class="form-control" name="phone" placeholder="Phone" required/>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="towncity">City</label>
									<input type="text" class="form-control" name="city" placeholder="City" required/>
								</div>
							</div>
							
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="streetaddress">Address</label>
									<input type="text" class="form-control" name="address" placeholder="Address" required/>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="form-group">
							<input type="submit" class="btn btn-primary py-3 px-4" value="Place order" name="place_order"/>
							</div>
						</div>
					</form><!-- END -->
				</div>
				<div class="col-xl-5">
					<div class="row mt-5 pt-3">
						<div class="col-md-12 d-flex mb-5">
							<div class="cart-detail cart-total p-3 p-md-4">
								<h3 class="billing-heading mb-4">Cart Total</h3>
								<p class="d-flex total-price">
									<span>Total</span>
									<span>₹<?php echo $_SESSION['total']; ?></span>
								</p>
							</div>
						</div>
						
					</div>
				</div> <!-- .col-md-8 -->
			</div>
		</div>
	</section> <!-- .section -->

	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
		<div class="container py-4">
			<div class="row d-flex justify-content-center py-5">
				<div class="col-md-6">
					<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
					<span>Get e-mail updates about our latest shops and special offers</span>
				</div>
				<div class="col-md-6 d-flex align-items-center">
					<form action="#" class="subscribe-form">
						<div class="form-group d-flex">
							<input type="text" class="form-control" placeholder="Enter email address">
							<input type="submit" value="Subscribe" class="submit px-3">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

<?php include('layouts/footer.php') ?>