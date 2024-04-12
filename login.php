<?php
session_start();
include("server/connection.php");

// Redirect to account page if already logged in
if(isset($_SESSION["logged_in"])) {
    header("location: Account.php");
    exit;
}

// Handle login form submission
if(isset($_POST['login_btn'])) {
    $Email = $_POST['email'];
    $Password = md5($_POST['password']);
    $stmt = $conn->prepare('SELECT user_id,user_name,user_email,user_password FROM users where user_email=? AND user_password=? LIMIT 1');
    $stmt->bind_param('ss', $Email, $Password);

    if($stmt->execute()) {
        $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
        
        if($stmt->fetch()) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;
            header('location: Account.php?message=logged in successfully');
            exit;
        } else {
            header('location: login.php?error=could not verify your account');
            exit;
        }
    } else {
        header('location: login.php?error=something went wrong');
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
                    <input type="submit" class="btn" id="login-btn" name="login_btn" value="login" />
                </div>
                <div class="form-group">
                    <a id="register-url" href="Register.php" class="btn"> Don't have an account? Register </a>
                </div>
            </form>
        </div>
    </section>


    <?php  include('layouts/footer.php'); ?> 