<?php
session_start();
include("server/connection.php");

if (isset($_SESSION["logged_in"])) {
    header("location: Account.php");
    exit;
}

if (isset($_POST["Register"])) {
    $Name = $_POST['name'];
    $Email = $_POST['email'];
    $Password = $_POST['password'];
    $ConfirmPassword = $_POST['ConfirmPassword'];

    if ($Password !== $ConfirmPassword) {
        $_SESSION['error'] = "Passwords don't match";
        header('location: Register.php');
        exit;
    }

    if (strlen($Password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters";
        header('location: Register.php');
        exit;
    }

    $stmt1 = $conn->prepare('SELECT COUNT(*) FROM users WHERE user_email = ?');
    $stmt1->bind_param('s', $Email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->fetch();
    $stmt1->close();

    if ($num_rows != 0) {
        $_SESSION['error'] = "User with this email already exists";
        header('location: Register.php');
        exit;
    }

    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare('INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $Name, $Email, $hashedPassword);

    if ($stmt->execute()) {
        $_SESSION['user_email'] = $Email;
        $_SESSION['user_name'] = $Name;
        $_SESSION['logged_in'] = true;
        header('location: Account.php?message=You registered successfully');
        exit;
    } else {
        $_SESSION['error'] = "Could not create an account at the moment";
        header('location: Register.php');
        exit;
    }
}
?>






<?php include ('layouts/header.php'); ?>



<!--Register-->
<section class="my-5 py-5">
    <div class="container text mt-3 pt-5">
        <h2 class="form-weight-bold">Register</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="register-form" method="POST" action="Register.php">
            <p style="color:red;">
                <?php if (isset($_GET['error'])) {
                    echo $_GET['error'];
                } ?>
            </p>
            <!-- Updated input names to match PHP variables -->
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="register-password" name="password"
                    placeholder="Password" required />
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" id="register-confirm-password" name="ConfirmPassword"
                    placeholder="Confirm Password" required />
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="register-btn" name="Register" value="Register" />
            </div>
            <div class="form-group">
                <a id="login-url" href="login.php" class="btn btn-primary py-3 px-4"> Do you have an account? Login</a>
            </div>
        </form>
    </div>
</section>

<?php include ('layouts/footer.php'); ?>