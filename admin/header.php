<?php 
session_start();
?>
<?php include('../server/connection.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YourLocalMart Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #2E8B57; /* Green */
            color: #ffffff;
            padding-top: 3rem;
        }
        .sidebar ul {
            list-style-type: none;
            padding-left: 0;
        }
        .sidebar li {
            padding: 10px 20px;
            border-bottom: 1px solid #5a6268;
        }
        .sidebar li a {
            color: green;
            text-decoration: none;
        }
        .sidebar li a:hover {
            color: #ffffff;
            background-color: #4CAF50; /* Light Green on hover */
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a href="#" class="navbar-brand col-md-3 col-lg-2 me-0 px-3"><h2>Your<span style="color: Green;">Local</span>Mart</h2></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php if(isset($_SESSION['admin_logged_in'])) {?>
    <a href="logout.php?logout=1" class="navbar-brand col-md-3 col-lg-2 me-0 px-3">Sign out</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php } ?>
    
</header>
