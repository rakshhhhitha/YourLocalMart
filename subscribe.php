<?php include('server/connection.php'); ?>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the email address
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email address
        echo "Invalid email address";
        exit;
    }


    // Prepare and execute SQL statement to insert email into database
    $stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    if ($stmt->execute()) {
        echo "You have been successfully subscribed!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close database connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect back to the subscription page if the form is not submitted
    header("Location: index.php");
    exit;
}
?>
