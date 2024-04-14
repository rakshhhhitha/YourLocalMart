<?php
session_start();
include("server/connection.php");

if(isset($_SESSION["logged_in"])) {
    header("location: Account.php");
    exit;
}

if(isset($_POST['login_btn'])) {
    $Email = $_POST['email'];
    $Password = $_POST['password'];
    $stmt = $conn->prepare('SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email=? LIMIT 1');
    $stmt->bind_param('s', $Email);

    if($stmt->execute()) {
        $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
        
        if($stmt->fetch() && password_verify($Password, $user_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;
            header('location: Account.php?message=Logged in successfully');
            exit;
        } else {
            $_SESSION['error'] = "Could not verify your account";
            header('location: login.php');
            exit;
        }
    } else {
        $_SESSION['error'] = "Something went wrong";
        header('location: login.php');
        exit;
    }
}
?>





<?php  include('layouts/header.php'); ?> 





<!--Login-->
<section class="my-5 py-5">
        <div class="container text mt-3 pt-5">
            <h2 class="form-weight-bold">Login</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="login-form" method="POST" action="login.php">
                <p style="color:red" class="text-center"> <?php if(isset($_GET['error'])){ echo $_GET['error'];} ?></p>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="login-email" name="email" placeholder="Email"
                        required />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="password"
                        placeholder="Password" required />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary py-3 px-4" id="login-btn" name="login_btn" value="login" />
                </div>
                <div class="form-group">
                    <a id="register-url" href="Register.php" class="btn btn-primary py-3 px-4"> Don't have an account? Register </a>
                </div>
            </form>
        </div>
    </section>


    <?php  include('layouts/footer.php'); ?> 