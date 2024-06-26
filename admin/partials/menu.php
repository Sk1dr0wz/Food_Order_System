<?php 
    require('../config/constants.php'); 
    require('login-check.php');
?>

<html>
    <head>
        <title>Food Ordering System - Admin Control</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href=
    "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity=
    "sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
            crossorigin="anonymous">
    </head>
    
    <body>
        <!-- Menu -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="manage-delivery.php">Delivery</a></li>
                    |
                    <li><a href="manage-users.php">Users</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>

                    <li><a href="manage-restaurant.php">Restaurant</a></li>

                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu End -->