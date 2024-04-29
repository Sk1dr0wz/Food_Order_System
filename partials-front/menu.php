<?php require('config/constants.php'); 
if(date_default_timezone_get() != 'Asia/Kuala_Lumpur'){
date_default_timezone_set('Asia/Kuala_Lumpur');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- https://developer.mozilla.org/en-US/docs/Web/HTML/Viewport_meta_tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOS</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Adjusted logo placement */
        .navbar {
            position: relative;
        }

        .logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <section class="navbar">
        <div class="container">
            <!-- Logo -->
            <div class="logo">
                <a href="http://localhost/food-order/" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <!-- Other menu items -->
            <div class="menu text-left">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Menu</a>
                        <?php
                        if (!empty($_SESSION["user_id"])) {
                            echo '<li class="nav-item"><a href="order-current.php" class="nav-link active">Confirm Order</a> </li>';
                        }
                        ?>
                    </li>
                </ul>
            </div>
            <div class="menu text-right">
                <ul>
                    <?php
                    if (empty($_SESSION["user_id"])) {
                        echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>';
                    } else {
                        if ($_SESSION["admin"] == 1) {
                            echo '<li class="nav-item"><a href="admin" class="nav-link active">Admin</a> </li>';
                        }
                        echo '<li class="nav-item"><a href="delivery-current.php?delivery_id=';
                        echo  $_SESSION['d_id'];
                        echo '" class="nav-link active">My Delivery</a> </li>';
                        echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                    }

                    ?>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar End -->
