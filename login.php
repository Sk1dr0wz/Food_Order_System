<?php
// Initialize the session
session_start();
echo isset($_SESSION["loggedin"]);
// Check if the user is already logged in, if yes then redirect him to the welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

require('config/constants.php');

// Define error variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["user_name"]))){
        echo "<script>alert('Please enter your username.');</script>";
        $username_err = "Please enter your username.";
    } 
    else{
        $username = trim($_POST["user_name"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["user_pass"]))){
        echo "<script>alert('Please enter your password.');</script>";
        $password_err = "Please enter your password.";
    } 
    else{
        $password = trim($_POST["user_pass"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT user_id, user_name, user_pass FROM user WHERE user_name = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $user_id, $user_name, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(md5($password) === $hashed_password){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $user_id;
                            $_SESSION["user_name"] = $user_name;

                            $sql2 = "SELECT * FROM user WHERE user_id = '$user_id' and user_role='1'";
                            $query2 = mysqli_query($conn,$sql2);
                            if (mysqli_num_rows($query2) == 1) {
                                $_SESSION["admin"] = true;                            
                            }
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            echo "<script>alert('Invalid username or password.');
                            window.location='login.php'</script>";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    echo "<script>alert('Invalid username or password.');
                    window.location='login.php'</script>";
                }
            } 
            else{
                echo "<script>alert('Unknown error');
                window.location='login.php'</script>";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FOS</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
    <!-- Link external CSS file -->
   
    <link rel="stylesheet" href=
    "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity=
    "sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
            crossorigin="anonymous"> 
            <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="http://localhost/food-order/" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            <br>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar End -->

    <div class="wrapper">
    <div class="container my-4 ">
        <h2>Login</h2>
        <p>Please enter your user name and password.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="user_name" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="user_pass" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Click here</a> to register!</p>
        </form>
    </div>
    </div>
    <?php include('partials-front/footer.php'); ?>
