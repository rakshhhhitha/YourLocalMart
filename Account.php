<?php
session_start();
include ("server/connection.php");

if (!isset($_SESSION["logged_in"])) {
    header("location: login.php");
    exit;
}

if (isset($_GET["logout"])) {
    if (isset($_SESSION["logged_in"])) {
        unset($_SESSION["logged_in"]);
        unset($_SESSION["user_email"]);
        unset($_SESSION["user_password"]);
        header('location: login.php');
        exit;
    }
}

if (isset($_POST['change_password'])) {
    $password = $_POST['Password'];
    $confirm_password = $_POST['ConfirmPassword'];
    $user_email = $_SESSION['user_email'];

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords don't match";
        header('location: Account.php');
        exit;
    } else if (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters";
        header('location: Account.php');
        exit;
    } else {
        $stmt = $conn->prepare('UPDATE users SET user_password=? WHERE user_email=?');
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('ss', $hashed_password, $user_email);

        if ($stmt->execute()) {
            header('location: Account.php?message=Password has been updated successfully');
            exit;
        } else {
            $_SESSION['error'] = "Could not update password";
            header('location: Account.php');
            exit;
        }
    }
}

if (isset($_SESSION['logged_in'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $orders = $stmt->get_result();
}
?>


<!--header-->
<?php include ('layouts/header.php'); ?>


<!-- Account -->
<div class="container text-center mt-3">
    <p style="color: green; font-size: 24px; font-weight: bold;">
        <?php if (isset($_GET['message'])) {
            echo $_GET['message'];
        } ?>
    </p>
    <p class="text-center" style="color:red; font-size: 24px; font-weight: bold;">
        <?php if (isset($_GET['error'])) {
            echo $_GET['error'];
        } ?>
    </p>
</div>
<section class="ftco-section ftco-cart">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <h3 class="font-weight-bold">Account info</h3>
            <hr class="mx-auto">
            <div class="account-info">
                <p>Name : <span><?php if (isset($_SESSION['user_name'])) {
                    echo $_SESSION['user_name'];
                } ?></span></p>
                <p>Email : <span><?php if (isset($_SESSION['user_email'])) {
                    echo $_SESSION['user_email'];
                } ?></span>
                </p>
                <p><a href="#orders" id="orders-btn">Your Orders</a></p>
                <p><a href="Account.php?logout=1" class="btn btn-primary py-3 px-4" id="logout-btn">Logout</a></p>
            </div>
        </div>
        <hr>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <form id="account-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h3>Change Password</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="Password" id="account-password" />
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="account-password-confirm" name="ConfirmPassword" />
                </div>
                <div class="form-group">
                    <input type="submit" value="Change Password" name="change_password"
                        class="btn btn-primary py-3 px-4" id="change-pass-btn" />
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <h1>
                        <center>Your orders</center>
                    </h1>
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>Order ID</th>
                                <th>Order Cost</th>
                                <th>Order Status</th>
                                <th>Order Date</th>
                                <th>Order Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $orders->fetch_assoc()) { ?>
                                <tr class="text-center">
                                    <td class="product-name">
                                        <h3><?php echo $row['order_id']; ?></h3>
                                    </td>
                                    <td class="price">₹<?php echo $row['order_cost']; ?></td>
                                    <td class="product-name">
                                        <h3><?php echo $row['order_status']; ?></h3>
                                    </td>
                                    <td class="product-name">
                                        <h3><?php echo $row['order_date']; ?></h3>
                                    </td>
                                    <td>
                                        <form method="GET" action="order_details.php">
                                            <input type="hidden" value="<?php echo $row['order_status']; ?>"
                                                name="order_status" />
                                            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id" />
                                            <input class="btn btn-primary py-3 px-4" name="order_details_btn" type="submit"
                                                value="Details" />
                                        </form>
                                    </td>


                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>




<?php include ('layouts/footer.php'); ?>