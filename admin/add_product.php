<?php include ('header.php'); ?>

<div class="container-fluid">
    <div class="row">
        <div>
            <?php include ('sidemenu.php'); ?>
        </div>

        <div class="container-fluid">
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <h1 class="h2 mt-3">Dashboard</h1>

                <h2>Create Product</h2>
                <div class="table-responsive">


                    <div class="mx-auto container">
                        <form action="create_product.php" method="POST" id="create" enctype="multipart/form-data">
                            <p style="color:red;"><?php if (isset($_GET['error'])) {
                                                        echo $_GET['error'];
                                                    } ?></p>

                            
                            <div class="form-group mt-2">
                                <label>Product Name</label>
                                <input type="text" class="form-control"  id="product-name" name="product_name" placeholder="Product Name" />
                            </div>
                            <div class="form-group mt-2">
                                <label>Product Price</label>
                                <input type="text" class="form-control"  id="Product Price" name="product_price" placeholder="Product Price" />
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
                                <input type="text" class="form-control"  id="product-color" name="product_color" placeholder="Product Color" />
                            </div>
                            <div class="form-group mt-2">
                                <label>Product Offer</label>
                                <input type="text" class="form-control"  id="product-offer" name="special_offer" placeholder="Product Offer" />
                            </div>
                            <div class="form-group mt-2">
                                <label>Product Image 1</label>
                                <input type="text" class="form-control"  id="product-offer" name="image" placeholder="Product Offer" />
                            </div>
                            <div class="form-group mt-2">
                                <label>Product Image 2</label>
                                <input type="text" class="form-control"  id="product-offer" name="image2" placeholder="Product Offer" />
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" class="btn btn-primary" name="create_product" value="Create" />
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>