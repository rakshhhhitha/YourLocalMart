<?php
session_start();
include("../server/connection.php");

// Redirect to account page if already logged in
if(isset($_SESSION["admin_logged_in"])) {
    header("location: index.php");
    exit;
}

// Handle login form submission
if(isset($_POST['login_btn'])) {
    $Email = $_POST['email'];
    $Password = md5($_POST['password']);
    $stmt = $conn->prepare('SELECT admin_id,admin_name,admin_email,admin_password FROM admins where admin_email=? AND admin_password=? LIMIT 1');
    $stmt->bind_param('ss', $Email, $Password);

    if($stmt->execute()) {
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        
        if($stmt->fetch()) {
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;
            header('location: index.php?message=logged in successfully');
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


<style>
body {
    margin: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.login-section {
    text-align: center;
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    font-size: 2em;
    color: green;
}

.form-control {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    font-size: 1.2em;
}

.btn-primary {
    background-color: green;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1.2em;
    color: white;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: darkgreen;
}

.error-message {
    color: red;
}
</style>



<!--Login-->
<section class="my-5 py-5 text-center">
<h2>Your<span style="color: Orange;">Local</span>Mart</h2>
    <div class="container mt-3 pt-5">
        <h2 class="form-weight-bold" style="color: green; font-size: 2em;">Login</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="login-form" method="POST" action="login.php">
            <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error'];} ?></p>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary py-3 px-4" id="login-btn" name="login_btn" value="login" />
            </div>
        </form>
    </div>
</section>


   